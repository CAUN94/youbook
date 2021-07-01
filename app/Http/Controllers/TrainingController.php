<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Training;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Malahierba\ChileRut\ChileRut;
use Malahierba\ChileRut\Rules\ValidChileanRut;
use Carbon\Carbon;

class TrainingController extends Controller
{
    public function index(){
        $training_user = Auth::user()->student;
        $training_id  = $training_user->training_id;
        $training = Training::find($training_id);
        $days_dias = array(
            'Monday'=>'Lunes',
            'Tuesday'=>'Martes',
            'Wednesday'=>'Miércoles',
            'Thursday'=>'Jueves',
            'Friday'=>'Viernes',
            'Saturday'=>'Sábado',
            'Sunday'=>'Domingo'
            );
        return view('/training/index',compact('training','training_user','days_dias'));
    }

    public function trainingnew(){
        $trainings = Training::orderBy('name')->get();
        return view('/training/newtraining',compact('trainings'));
    }

    public function create_training_new(Request $request){
        $request['rut'] = str_replace('.','',$request['rut']);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'lastnames' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            // 'rut' => ['required', 'string', 'max:255', 'unique:users',new ValidChileanRut(new ChileRut)],
            'rut' => ['required', 'string', 'max:255', 'unique:users'],
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

        Student::create([
            'user_id' => $user->id,
            'training_id' => $request->plan,
            'settled' => False,
        ]);
        $data = [];
        $data['rut'] = $request['rut'];
        $data['password'] = $request['password'];
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return route('login');

    }

    public function traininguser(){
        $trainings = Training::orderBy('name')->get();
        return view('/training/training',compact('trainings'));
    }


    public function create_training_user(Request $request){

        $this->validate($request, [
            'plan' => ['required','nullable'],
        ]);




        Student::create([
            'user_id' => Auth::id(),
            'training_id' => $request->plan,
            'settled' => False,
        ]);
        return redirect('/');

    }
}
