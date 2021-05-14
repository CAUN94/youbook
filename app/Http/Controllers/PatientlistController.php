<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientlistController extends Controller
{
    public function index(Request $request)
    {
    	date_default_timezone_set('Chile/Continental');
    	if($request->date){
    		$bookings = Booking::latest()
                ->where('date',$request->date)
                ->where('professional_id',Auth::id())->get();
    		return view('admin.patientlist.index',compact('bookings'));
    	}
    	$bookings = Booking::latest()
            ->where('date',date('Y-m-d'))
            ->where('professional_id',Auth::id())->get();

    	return view('admin.patientlist.index',compact('bookings'));
    }

    public function toggleStatus($id)
    {
        $booking  = Booking::find($id);
        $booking->status =! $booking->status;
        $booking->save();
        return redirect()->back();

    }

    public function allTimeAppointment()
    {
        $bookings = Booking::latest()->paginate(20);
        return view('admin.patientlist.index',compact('bookings'));
    }
}
