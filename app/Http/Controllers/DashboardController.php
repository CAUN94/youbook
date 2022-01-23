<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function calendar() {
		if (!Auth::user()->dashboard()) {
			return redirect('/');
		}
		return view('/calendar');
	}

	public function index() {
		if (!Auth::user()->dashboard()) {
			return redirect('/');
		}
		return view('/dashboard');
	}

	public function week() {
		if (!Auth::user()->dashboard()) {
			return redirect('/');
		}
		return view('/week');
	}
}
