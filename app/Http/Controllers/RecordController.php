<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index()
    {
    	date_default_timezone_set('Chile/Continental');
		$bookings =  Booking::where('date',date('Y-m-d'))->where('status',1)->where('professional_id',auth()->user()->id)->get();
		return view('record.index',compact('bookings'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
    	$data  = $request->all();
    	$data['indications'] = implode(',',$request->indications);
    	Record::create($data);
    	return redirect()->back()->with('message','Ficha Guardada');
    }

    public function show($userId,$date)
    {
        $record = Record::where('user_id',$userId)->where('date',$date)->first();
        return view('record.show',compact('record'));
    }

    //get all patients from prescription table
    public function patientsFromRecord()
    {
        $patients = Record::get();
        return view('record.all',compact('patients'));
    }
}
