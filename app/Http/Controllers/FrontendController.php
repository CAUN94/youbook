<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\BookingTrain;
use App\Models\Record;
use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
	public function index()
	{
		date_default_timezone_set('Chile/Continental');
		if(request('date')){
            $professionals = $this->findProfessionalsBasedOnDate(request('date'));
            return view('welcome',compact('professionals'));
        }
		$professionals = Appointment::where('date',date('Y-m-d'))->get();
		return view('welcome',compact('professionals'));
	}

	public function show($professionalId,$date)
	{
		$appointment = Appointment::where('user_id',$professionalId)->where('date',$date)->first();
		$times = Time::where('appointment_id',$appointment->id)->where('status',0)->get();
		$professional = User::where('id',$professionalId)->first();
        $professional_Id = $professionalId;
		return view('appointment',compact('date','times','professional','professional_Id'));
	}
	// public function store(Request $request)
	// {
	// 	dd($request->all());
	// }

	public function findProfessionalsBasedOnDate($date)
    {
        $professionals = Appointment::where('date',$date)->get();
        return $professionals;
    }


	public function store(Request $request)
    {
        date_default_timezone_set('Chile/Continental');

        $request->validate(['time'=>'required']);
        $check=$this->checkBookingTimeInterval($request->professionalId);
        if($check){
            return redirect()->back()->with('message','Ya tienes una cita para este día con este profesional');
        }


        Booking::create([
            'user_id'=> auth()->user()->id,
            'professional_id'=> $request->professionalId,
            'time'=> $request->time,
            'date'=> $request->date,
            'status'=>0
        ]);

        Time::where('appointment_id',$request->appointmentId)
            ->where('time',$request->time)
            ->update(['status'=>1]);
        //send email notification
        $professionalName = User::where('id',$request->professionalId)->first();
        $mailData = [
            'name'=>auth()->user()->name,
            'time'=>$request->time,
            'date'=>$request->date,
            'professionalName' => $professionalName->name

        ];
        // try{
        //    // \Mail::to(auth()->user()->email)->send(new AppointmentMail($mailData));

        // }catch(\Exception $e){

        // }

        return redirect()->back()->with('message','Ahora agendada');
    }

    public function storetrain(Request $request)
    {
        date_default_timezone_set('Chile/Continental');

        BookingTrain::create([
            'user_id'=> auth()->user()->id,
            'train_appointment_id'=> $request->getid,
            'status'=> 0,
        ]);


        //send email notification
        // $professionalName = User::where('id',$request->professionalId)->first();
        // $mailData = [
        //     'name'=>auth()->user()->name,
        //     'time'=>$request->time,
        //     'date'=>$request->date,
        //     'professionalName' => $professionalName->name

        // ];
        // try{
        //    // \Mail::to(auth()->user()->email)->send(new AppointmentMail($mailData));

        // }catch(\Exception $e){

        // }

        return redirect()->back()->with('message','Hora Reservada');


    }

    public function deletetrain(Request $request)
    {
        date_default_timezone_set('Chile/Continental');

        $bookingTrain = BookingTrain::where(
            'user_id', auth()->user()->id)
            ->where('train_appointment_id',$request->getid)
            ->delete();

        return redirect()->back()->with('message','Hora Cancelada');


    }

    public function checkBookingTimeInterval($professional)
    {
        return Booking::orderby('id','desc')
            ->where('user_id',auth()->user()->id)
            ->whereDate('created_at',date('Y-m-d'))
            ->where('professional_id',$professional)
            ->exists();
    }

    public function myBookings()
    {
        $appointments = Booking::latest()->where('user_id',auth()->user()->id)->get();
        return view('booking.index',compact('appointments'));
    }

    public function findProfessionals(Request $request)
    {
        $professionals = Appointment::with('professional')->whereDate('date',$request->date)->get();
        return $professionals;
    }

    public function ProfessionalToday(Request $request)
    {
        $professionals = Appointment::with('professional')->whereDate('date',date('Y-m-d'))->get();
        return $professionals;
    }

    public function myRecords()
    {
        $records = Record::where('user_id',auth()->user()->id)->get();
        return view('my-records',compact('records'));
    }


}
