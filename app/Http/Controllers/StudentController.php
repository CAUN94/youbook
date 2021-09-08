<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = User::find($id);
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->discount = $request->discount;
        $user->save();
        return redirect('/students');
    }

    public function settled($id)
    {
        $student = Student::where('user_id',$id)->first();
        $student->settled = !$student->settled;

        if ($student->settled){
            $user = User::find($id);
            $to_name = $user->name;
            $to_email = $user->email;
            $training = Training::find($student->training_id);
            $price = $user->planPrice();
            $data = array('user'=> $user, 'info' => $training, 'price' => $price);

            try{
               Mail::send('emails.settleduser', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email,$to_name)
                ->subject('You Train Better');
                $message->from('desarrollo@justbetter.cl','Confirmación de Pago');
                });

            }catch(\Exception $e){
            }
        }
        else {
            $user = User::find($id);
            $to_name = $user->name;
            $to_email = $user->email;
            $training = Training::find($student->training_id);
            $price = $user->planPrice();
            $price = $user->planPrice();
            $data = array('user'=> $user, 'info' => $training, 'price' => $price);

            try{
               Mail::send('emails.reminderduser', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email,$to_name)
                ->subject('You Train Better');
                $message->from('desarrollo@justbetter.cl','Recordatorio de Pago');
                });

            }catch(\Exception $e){
            }
        }

        $student->save();
        return redirect()->back();
    }

    public function reminder($id)
    {
        $student = Student::where('user_id',$id)->first();
        $user = User::find($id);
        $to_name = $user->name;
        $to_email = $user->email;
        $training = Training::find($student->training_id);
        $price = $user->planPrice();
        $data = array('user'=> $user, 'info' => $training, 'price' => $price);

        try{
           Mail::send('emails.reminderduser', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email,$to_name)
            ->subject('You Train Better');
            $message->from('desarrollo@justbetter.cl','Recordatorio de Pago');
            });

        }catch(\Exception $e){
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::where('user_id',$id)->first();
        $student->delete();
        return redirect()->back();
    }
}
