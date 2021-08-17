<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Appointment;
use App\Models\AppointmentApp;
use App\Models\Payment;
use App\Models\Transfer;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth::user()->hasRole('administrador'|| auth::user()->hasRole('professional'))){
            return redirect('/dashboard');
        }
        return redirect('/');
    }

    public function youapp()
    {
        $action_last = Action::last_register();
        $appointment_last = AppointmentApp::last_register();
        $treatment_last = Treatment::last_register();
        $payment_last = Payment::last_register();
        $fintoc_last = Transfer::last_register();
        return view('youapp.home',compact('action_last','appointment_last','treatment_last','payment_last','fintoc_last'));
    }

    public function panel()
    {
        auth::user()->isAdmin();
        $pacientes = DB::table('appointment_apps')->groupBy('Rut_Paciente')->orderBy('Fecha_Generación','desc')->get();
        return view('youapp.you-wsp/index',compact('pacientes'));
    }

    public function excel()
    {
        auth::user()->isAdmin();
        return view('youapp.you-wsp/excel');
    }

    public function canceled()
    {
        auth::user()->isAdmin();
        $canceled = AppointmentApp::canceled();
        return view('youapp.canceled/index',compact('canceled'));
    }

    public function today()
    {
        auth::user()->isAdmin();
        $date = Carbon::today();
        $pacientes = AppointmentApp::appoiments($date);
        $appointment_last = AppointmentApp::last_register();

        return view('youapp.you-wsp/today',compact('appointment_last','pacientes'));
    }

    public function tomorrow()
    {
        auth::user()->isAdmin();
        $pacientes = AppointmentApp::tomorrow_appoiments();
        $appointment_last = AppointmentApp::last_register();

        return view('youapp.you-wsp/tomorrow',compact('appointment_last','pacientes'));
    }

    public function training()
    {
        auth::user()->isAdmin();
        return view('youapp.you-wsp/training');
    }

    // Falta hacer refactoring
    public function general()
    {
        auth::user()->isAdmin();
        // $now = Carbon::now()->addMonth();
        $last = Carbon::now()->subYear();
        $endOfYear = $last->copy()->endOfYear();
        $startOfYear = $last->copy()->startOfYear();

        // return Action::occupation_summary($startOfYear,$endOfYear);
        $lastyear = DB::select( DB::raw("select month(Fecha_Realizacion) as Fecha,
               sum(Precio_Prestacion) Prestacion,sum(Abonoo) as Abono
        from actions
        where Fecha_Realizacion <= '".$endOfYear."' and Fecha_Realizacion >= '".$startOfYear."' and Profesional not like 'Internos You'
        group by month(Fecha_Realizacion)  order by Fecha_Realizacion asc;") );

        $conveniosLast = DB::select( DB::raw("select year(Fecha) as año,month(Fecha) as mes,count(Query.T) as Atenciones,count(CASE when C <> 'Sin Convenio' and C <> 'Embajador' and C <> 'Pro Bono' THEN 1 END) as Convenio, count(CASE when C = 'Sin Convenio' THEN 1 END) as Sin_Convenio, count(CASE when C = 'Embajador' or C = 'Pro Bono' THEN 1 END) as Embajador
            from (select Profesional as Pro,Tratamiento_Nr as T, sum(Precio_Prestacion) as PP,
                         sum(Abonoo) as A, Convenio as C, concat(Nombre,' ',Apellido) as P, Estado as E,
                         Fecha_Realizacion as Fecha
            from actions where Fecha_Realizacion <= '".$endOfYear."' and Fecha_Realizacion >= '".$startOfYear."' and Profesional not like 'Internos You'
            group by Profesional,Tratamiento_Nr) as Query group by year(Fecha),month(Fecha)
            order by año desc,mes asc;") );

        // return $conveniosLast;

        $now = Carbon::now();
        $endOfYear = $now->copy()->endOfYear();
        $startOfYear = $now->copy()->startOfYear();

        $actualyear = DB::select( DB::raw("select month(Fecha_Realizacion) as Fecha,
               sum(Precio_Prestacion) Prestacion,sum(Abonoo) as Abono
        from actions
        where Fecha_Realizacion <= '".$endOfYear."' and Fecha_Realizacion >= '".$startOfYear."' and Profesional not like 'Internos You'
        group by month(Fecha_Realizacion)  order by Fecha_Realizacion asc;") );

        $conveniosActual = DB::select( DB::raw("select year(Fecha) as año,month(Fecha) as mes,count(Query.T) as Atenciones,count(CASE when C <> 'Sin Convenio' and C <> 'Embajador' and C <> 'Pro Bono' THEN 1 END) as Convenio, count(CASE when C = 'Sin Convenio' THEN 1 END) as Sin_Convenio, count(CASE when C = 'Embajador' or C = 'Pro Bono' THEN 1 END) as Embajador
            from (select Profesional as Pro,Tratamiento_Nr as T, sum(Precio_Prestacion) as PP,
                         sum(Abonoo) as A, Convenio as C, concat(Nombre,' ',Apellido) as P, Estado as E,
                         Fecha_Realizacion as Fecha
            from actions where Fecha_Realizacion <= '".$endOfYear."' and Fecha_Realizacion >= '".$startOfYear."' and Profesional not like 'Internos You'
            group by Profesional,Tratamiento_Nr) as Query group by year(Fecha),month(Fecha)
            order by año desc,mes asc;") );

        // return $conveniosActual;

        return view('youapp.reports.index',compact('lastyear','actualyear','conveniosLast','conveniosActual'));
    }
}
