<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	if(Auth::user()->dashboard()){
    		return redirect('/');
    	}
    	return view('/dashboard');
    }

    public function calendar()
    {
        if(Auth::user()->hasRole("paciente")){
            return redirect('/');
        }
        return view('/calendar');
    }

    public function week()
    {

        if(Auth::user()->hasRole("paciente")){
            return redirect('/');
        }
        return view('/week');
    }


}
