<?php

namespace App\Models;

use App\Models\BookingTrain;
use App\Models\Training;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TrainAppointments extends Model
{
    use HasFactory;
    protected $table = 'train_appointments';

    public function training(){
        return $this->belongsTo(Training::class);
    }

    public function status(){
        if (count(BookingTrain::where('user_id',Auth::user()->id)->where('train_appointment_id',$this->id)->get()) >0){
            return True;
        }
        return False;
    }

    public function isGroup(){
        if ($this->training->type == 'group'){
            return True;
        }
        return False;
    }



}
