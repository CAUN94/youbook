<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function trainingnew(){
        $trainings = Training::orderBy('name')->get();
        return view('/training/newtraining',compact('trainings'));
    }
}
