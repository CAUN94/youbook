<?php

namespace App\Models;

use App\Models\Student;
use App\Models\TrainAppointments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingTrain extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function train_appointment(){
        return $this->belongsTo(TrainAppointments::class,'train_appointment_id','id')->first();
    }

    public function student(){
        return $this->belongsTo(User::class,'user_id','id')->first();
    }

    public function studentcount(){
        return $this->hasmany(User::class,'id','user_id')->count();
    }



}
