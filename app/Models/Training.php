<?php

namespace App\Models;

use App\Models\TrainAppointments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Training extends Model
{
    use HasFactory;

    public function appointments(){
        $today = new Carbon();

        $from = $today->format('Y-m-d');
        $to = $today->endOfMonth()->format('Y-m-d');
        return $this->hasMany(TrainAppointments::class)->whereBetween('date', [$from, $to])->orderby('date')->orderby('time', 'desc');


        if($today->dayOfWeek == Carbon::THURSDAY){

        }
        $from = $today->format('Y-m-d');
        $to = $today->endOfWeek()->format('Y-m-d');


        return $this->hasMany(TrainAppointments::class)->whereBetween('date', [$from, $to])->orderby('date')->orderby('time', 'desc');
    }

    public function hasAppointments(){
        $from = Carbon::now()->startOfMonth()->format('Y-m-d');
        $to = Carbon::now()->endOfMonth()->addWeeks(1)->format('Y-m-d');
        return $this->hasMany(TrainAppointments::class)->whereBetween('date', [$from, $to]);
    }

    public function monthAppointments(){
        $from = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $to = Carbon::now()->endOfMonth()->addWeeks(1)->format('Y-m-d');
        return $this->hasMany(TrainAppointments::class)->whereBetween('date', [$from, $to])
            ->orderby('date','desc')->get();
    }

    public function hasStudents(){
        return $this->hasMany(Student::class)->where('settled',1)->count();
    }

    public function monedaPrice(){
        $fmt = numfmt_create('es_CL', \NumberFormatter::CURRENCY);
        return  $fmt->formatCurrency($numero, "CLP");
    }

    public function planPrice(){
            if ($this->type == 'duo'){
                return ($this->price*(1 - ($this->discount/100)))/2;
            }

            return $this->price*(1 - ($this->discount/100));
    }
}
