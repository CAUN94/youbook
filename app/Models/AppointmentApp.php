<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppointmentApp extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function last_register()
    {
        return AppointmentApp::max('updated_at');
    }

     public static function appoiments($date)
    {
        return DB::select( DB::raw("select a.id,a.Profesional , a.Tratamiento_Nr, Estado,Nombre_paciente,Apellidos_paciente,Celular,Hora_inicio,TotalAtencion+Avance as TotalAtencion,Mail from appointment_apps as a join treatments
        on a.Tratamiento_Nr = treatments.Atencion where  a.id in (SELECT max(id) FROM appointment_apps where Fecha = '".$date."'  group by Tratamiento_Nr) and Estado not in ('Anulado','Cambio de Fecha') order by Hora_inicio asc") );
    }

    public static function tomorrow_appoiments()
    {
        $tomorrow = Carbon::tomorrow();
        if ($tomorrow->format('l') == 'Saturday' or $tomorrow->format('l') == 'Friday'){
            $monday = $tomorrow->copy()->addDays(2);

            return DB::select( DB::raw("select a.id,a.Profesional , a.Tratamiento_Nr, Estado,Nombre_paciente,Apellidos_paciente,Celular,Hora_inicio,TotalAtencion+Avance as TotalAtencion,Mail,Fecha from appointment_apps as a join treatments
        on a.Tratamiento_Nr = treatments.Atencion where  a.id in (SELECT max(id) FROM appointment_apps where Fecha = '".$tomorrow."' or Fecha ='".$monday."'  group by Tratamiento_Nr) and Estado in ('No Confirmado','Agenda Online') order by Hora_inicio asc") );
        }
        elseif ($tomorrow->format('l') == 'Sunday'){
            $monday = $tomorrow->copy()->addDays(1);
            return DB::select( DB::raw("select a.id,a.Profesional , a.Tratamiento_Nr, Estado,Nombre_paciente,Apellidos_paciente,Celular,Hora_inicio,TotalAtencion+Avance as TotalAtencion,Mail,Fecha from appointment_apps as a join treatments
        on a.Tratamiento_Nr = treatments.Atencion where  a.id in (SELECT max(id) FROM appointment_apps where Fecha = '".$monday."' or Fecha ='".$monday."'  group by Tratamiento_Nr) and Estado in ('No Confirmado','Agenda Online') order by Hora_inicio asc") );
        }
        return DB::select( DB::raw("select a.id,a.Profesional , a.Tratamiento_Nr, Estado,Nombre_paciente,Apellidos_paciente,Celular,Hora_inicio,TotalAtencion+Avance as TotalAtencion,Mail,Fecha from appointment_apps as a join treatments
        on a.Tratamiento_Nr = treatments.Atencion where  a.id in (SELECT max(id) FROM appointment_apps where Fecha = '".$tomorrow."'  group by Tratamiento_Nr) and Estado in ('No Confirmado','Agenda Online') order by Hora_inicio asc") );
    }

    public static function form_appoiments($day){
        return DB::select( DB::raw("select a.id,a.Profesional , a.Tratamiento_Nr, Estado,Nombre_paciente,Apellidos_paciente,Celular,Hora_inicio,TotalAtencion+Avance as TotalAtencion, Mail, Fecha from appointments as a join treatments
        on a.Tratamiento_Nr = treatments.Atencion where  a.id in (SELECT max(id) FROM appointments where Fecha = '".$day."'  group by Tratamiento_Nr) and Estado in ('No Confirmado','Agenda Online') order by Fecha asc,Hora_inicio asc") );
    }

    public static function tomorrow_appoiment($nr){
        return DB::select( DB::raw("select a.id, a.Tratamiento_Nr, a.Profesional , a.Rut_Paciente,Fecha, Estado,Nombre_paciente,Apellidos_paciente,Celular,Hora_inicio,Mail,Fecha from appointment_apps as a  where  a.id in (SELECT max(id) FROM appointment_apps group by Tratamiento_Nr) and a.Tratamiento_Nr = '".$nr."' order by Hora_inicio asc") );
    }

    public static function noRepeat()
    {
        return AppointmentApp::groupBy('Estado','Fecha','Hora_inicio','Hora_termino','Fecha_Generación','Tratamiento_Nr','Profesional','Rut_Paciente','Nombre_paciente','Apellidos_paciente','Mail','Telefono','Celular','Convenio','Convenio_Secundario','Generación_Presupuesto','Sucursal')->get();
    }

    public static function canceled()
    {
        $firsday = Carbon::create(null,null,null,null,null,null)->startOfWeek()->subDays(7);
        $lastday = Carbon::create(null,null,null,23,55,55);
        return DB::select( DB::raw("select Nombre_paciente,Hora_inicio,Apellidos_paciente,Max(Fecha),Estado,Celular,Mail,Profesional from appointment_apps where fecha <= '".$lastday."' and fecha >= '".$firsday."' and Estado in ('Anulado','No asiste') group by Rut_Paciente;") );
    }
}
