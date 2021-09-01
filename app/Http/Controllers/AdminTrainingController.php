<?php

namespace App\Http\Controllers;

use App\Models\BookingTrain;
use App\Models\Student;
use App\Models\TrainAppointments;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminTrainingController extends Controller
{
    public function students(){
        $students_id = Student::all('user_id')->pluck('user_id')->toArray();
        $students = User::whereIn('id', $students_id)->orderBy('name')->get();

        return view('admin.training.students',compact('students'));
    }

    public function classes_today($id){
        date_default_timezone_set('Chile/Continental');
        $date = date('Y-m-d');
        $training = TrainAppointments::find($id);
        $students_id = BookingTrain::where('train_appointment_id',$id)->pluck('user_id')->toArray();
        $students = User::whereIn('id', $students_id)->get();
        $days_dias = array(
            'Monday'=>'Lunes',
            'Tuesday'=>'Martes',
            'Wednesday'=>'Miércoles',
            'Thursday'=>'Jueves',
            'Friday'=>'Viernes',
            'Saturday'=>'Sábado',
            'Sunday'=>'Domingo'
            );
        return view('admin.training.classes',compact('students','training','days_dias','id'));
    }

    public function toggleStatus($student_id,$book_id)
    {
        $train = BookingTrain::where('user_id',$student_id)->where('train_appointment_id',$book_id)->first();
        $train->status = ! $train->status;
        $train->save();
        return redirect()->back();

    }
}
