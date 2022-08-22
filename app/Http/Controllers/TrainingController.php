<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Student;
use App\Models\Training;
use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Malahierba\ChileRut\ChileRut;
use Malahierba\ChileRut\Rules\ValidChileanRut;

class TrainingController extends Controller
{
    public function index(){
        $training_user = Auth::user()->student;
        $training_id  = $training_user->training_id;
        $training = Training::find($training_id);
        $fmt = numfmt_create('es_CL', \NumberFormatter::CURRENCY);
        $price = numfmt_format_currency($fmt, $training->price, "CLP");
        $days_dias = array(
            'Monday'=>'Lunes',
            'Tuesday'=>'Martes',
            'Wednesday'=>'Miércoles',
            'Thursday'=>'Jueves',
            'Friday'=>'Viernes',
            'Saturday'=>'Sábado',
            'Sunday'=>'Domingo'
            );
        return view('/training/index',compact('training','training_user','days_dias','price'));
    }

    public function delete(Request $request){
        Student::where('user_id',$request->getid)->first()->delete();
        return redirect('/');
    }

    public function training(){
        $name = 'You Entrenamiento';
        if(!auth::user()->isAdmin()){
                abort(401);
        }
        if(auth::user()->isAdmin()){
            $actions = Action::professionalCloseMonth($name);
            $summary = $this->summary($actions);
            foreach ($actions as $key => $action) {
                $actions[$key]->Prestación = $this->moneda_chilena($actions[$key]->Prestación);
                $actions[$key]->Abono = $this->moneda_chilena($actions[$key]->Abono);
            }
            $goal = 300;
            $percentage = round($summary['Total']*100/$goal,1);
            $remuneration = $this->moneda_chilena($summary['Prestación']*$this->coefficient($name));
            $summary['Prestación'] = $this->moneda_chilena($summary['Prestación']);
            $summary['Abono'] = $this->moneda_chilena($summary['Abono']);

            $students = Student::where('settled',1);
            $students_all = $students->get();
            $sum = 0;
            foreach($students_all as $student){
                $sum += $student->training->price;
            }
            $sum = $this->moneda_chilena($sum);
            $trainings = $students->groupBy('training_id')->pluck('training_id');
            return view('/training/panel',compact('students_all','sum','trainings','summary'));

        }
    }

    public function trainingnew(){

        $trainings = Training::orderBy('name')->where('type','<>','you')->get();
        if (Auth::check()){
          if(Auth::user()->isStudent()){
            return redirect('/training');
            }
        }

        if (Auth::check()){
          if(Auth::user()->isTeamYou()){
            $trainings = Training::orderBy('name')->get();
            }
        }

        $trainings = $trainings->map(function ($item, $key) {
            $fmt = numfmt_create('es_CL', \NumberFormatter::CURRENCY);
            $item->price = numfmt_format_currency($fmt, $item->price, "CLP");
            return $item;
        });

        return view('/training/newtraining',compact('trainings'));
    }

    public function create_training_new(Request $request){
        $request['rut'] = str_replace('.','',$request['rut']);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'lastnames' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'rut' => ['required', 'string', 'max:255', 'unique:users',new ValidChileanRut(new ChileRut)],
            // 'rut' => ['required', 'string', 'max:255', 'unique:users'],
            'plan' => ['required'],
            'gender' => ['required', 'string','in:masculino,femenino,no'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request['name'],
            'lastnames' => $request['lastnames'],
            'rut' => str_replace('.','',$request['rut']),
            'email' => $request['email'],
            'gender' => $request['gender'],
            'role_id' => 3,
            'password' => Hash::make($request['password']),
        ]);

        $user_role = UserRole::create([
                'role_id' => 3,
                'user_id' => $user->id
            ]
        );

        $training = Training::findorfail($request->plan);
        if ($training->price == 0){
            $settled = True;
        }
        else{
            $settled = False;
        }
        $student = Student::create([
            'user_id' => $user->id,
            'training_id' => $request->plan,
            'settled' => $settled,
        ]);

        $to_name = $user->name;
        $to_email = $user->email;
        $training = Training::findorfail($student->training_id);
        $price = $user->planPrice();
        $data = array('user'=> $user, 'info' => $training, 'price' => $price);

        try{
           Mail::send('emails.trainuser', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email,$to_name)
            ->bcc('clinica@justbetter.cl')
            ->bcc('you@justbetter.cl')
            ->subject('You Registro de Plan');
            $message->from('desarrollo@justbetter.cl','Registro de Plan');
            });

        }catch(\Exception $e){
            return $e;
        }

        $to_name = $user->name;
        $to_email = 'cristobalugarte6@gmail.com';

        try{
           Mail::send('emails.adminuserpay', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->bcc('clinica@justbetter.cl')
            ->bcc('you@justbetter.cl')
            ->subject('Nuevo Registro '.$to_name);
            $message->from('desarrollo@justbetter.cl','Registro Entrenamiento');
            });

        }catch(\Exception $e){
        }

        $data = [];
        $data['rut'] = $request['rut'];
        $data['password'] = $request['password'];

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect('/training');
        }

        return route('login');

    }

    public function traininguser(){
        if(Auth::user()->isStudent()){
            return redirect('/training');
        }
        $trainings = Training::orderBy('name')->where('type','<>','you')->get();
        if (Auth::check()){
          if(Auth::user()->isTeamYou()){

            $trainings = Training::orderBy('name')->get();
            }
        }
        $trainings = $trainings->map(function ($item, $key) {
            $fmt = numfmt_create('es_CL', \NumberFormatter::CURRENCY);
            $item->price = numfmt_format_currency($fmt, $item->price, "CLP");
            return $item;
        });
        return view('/training/training',compact('trainings'));
    }


    public function create_training_user(Request $request){

        $this->validate($request, [
            'plan' => ['required','nullable'],
        ]);
        $training = Training::find($request->plan);
        if ($training->price == 0){
            $settled = True;
        }
        else{
            $settled = False;
        }
        $student = Student::create([
            'user_id' => Auth::id(),
            'training_id' => $request->plan,
            'settled' => $settled,
        ]);

        $to_name = Auth::user()->name;
        $to_email = Auth::user()->email;
        $training = Training::find($student->training_id);
        $price = Auth::user()->planPrice();
        $data = array('user'=> Auth::user(), 'info' => $training, 'price' => $price);

        try{
           Mail::send('emails.trainuser', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email,$to_name)
            ->subject('You Registro de Plan');
            $message->from('desarrollo@justbetter.cl','Registro de Plan');
            });

        }catch(\Exception $e){
        }

        $to_name = Auth::user()->name;
        $to_email = 'cristobalugarte6@gmail.com';

        try{
           Mail::send('emails.admintrain', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->bcc('clinica@justbetter.cl')
            ->subject('Nuevo Registro '.$to_name);
            $message->from('desarrollo@justbetter.cl','Registro Entrenamiento');
            });

        }catch(\Exception $e){
        }
        return redirect('/training');

    }

    public function summary($actions)
    {
        $values = ['Convenio','Sin_Convenio','Embajador','Prestación','Abono'];
        $summary = [];
        $summary['Total'] = 0;
        $summary['Convenio'] = 0;
        $summary['Sin_Convenio'] = 0;
        $summary['Embajador'] = 0;
        $summary['Prestación'] = 0;
        $summary['Abono'] = 0;

        foreach ($actions as $key => $action) {
            $summary['Total'] += 1;
            if($action->Convenio_Nombre != 'Sin Convenio' and $action->Convenio_Nombre != 'Embajador' and $action->Convenio_Nombre != 'Pro Bono'){
                $summary['Convenio'] +=1;
            }
            elseif ($action->Convenio_Nombre == 'Sin Convenio') {
                $summary['Sin_Convenio'] +=1;
            }
            elseif ($action->Convenio_Nombre = 'Embajador' or $action->Convenio_Nombre = 'Pro Bono') {
                $summary['Embajador'] +=1;
            }
            $summary['Prestación'] += $action->Prestación;
            $summary['Abono'] += $action->Abono;
        }
        return $summary;
    }

    public function moneda_chilena($numero){
        $fmt = numfmt_create('es_CL', \NumberFormatter::CURRENCY);
        return  $fmt->formatCurrency($numero, "CLP");
    }

    public function coefficient($name)
    {
        $coff = [
            'Alonso Niklitschek Sanhueza' => 0.6,
            'César Moya Calderón' => 0.42,
            'Daniella Vivallo Vera' => 0.45,
            'Juan Manuel Guzmán Habinger' => 0.7,
            'Iver Cristi Sánchez' => 0.6,
            'Renata Barchiesi Vitali' => 0.6,
            'Sofía Vitali Magasich' => 0.5,
            'Carolina Avilés Espinoza' => 0.7,
            'Mariano Neira Palomo' => 0.45,
            'Sara Tarifeño Ramos' => 1,
            'María Jesús Martinez León' => 0.45,
            'Melissa Ross Guerra' => 0.55,
            'Cristina Valenzuela ' => 0.42,
            'Adolfo Lopez Macera' => 0.46,
            'Diego Contreras Briceño' => 0.7,
            'You Entrenamiento' => 1,
            'Camila Valentini Rojas' => 0.42,
            'Jaime Pantoja Rodriguez' => 0.45,
            'Fernanda Cárdenas Muñoz' => 0.6,
            'Rocío Nuche Salgado' => 0.7,
            'Constanza Ahumada Huerta' => 0.32,
            'Antonio Ceresuela Phillips' => 0.7,
            'Ángel Saez Miranda' => 0.32,
            'Nicole Cedeño Wolf ' => 0.35,
            'Manuel Silva Ávila' => 0.56,
            'Josefa Andrea Valcárcel Silva' => 0.46,

        ];

        return $coff[$name];
    }
}
