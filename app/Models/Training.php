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
        $to = Carbon::now()->endOfMonth()->format('Y-m-d');
        return $this->hasMany(TrainAppointments::class)->whereBetween('date', [$from, $to]);
    }

    public function monthAppointments(){
        $from = Carbon::now()->startOfMonth()->format('Y-m-d');
        $to = Carbon::now()->endOfMonth()->format('Y-m-d');
        return $this->hasMany(TrainAppointments::class)->whereBetween('date', [$from, $to])
            ->orderby('date','desc')->get();
    }

    public function hasStudents(){
        return $this->hasMany(Student::class)->where('settled',1)->count();
    }

    public function monedaPrice(){
        $numero = $$this->price*(1 - ($this->discount/100));
        $numero = (string)$numero;
        $puntos = floor((strlen($numero)-1)/3);
        $tmp = "";
        $pos = 1;
        for($i=strlen($numero)-1; $i>=0; $i--){
        $tmp = $tmp.substr($numero, $i, 1);
        if($pos%3==0 && $pos!=strlen($numero))
        $tmp = $tmp.".";
        $pos = $pos + 1;
        }
        $formateado = "$ ".strrev($tmp);
        return $formateado;
    }

    public function planPrice(){
            if ($this->type == 'duo'){
                return ($this->price*(1 - ($this->discount/100)))/2;
            }

            return $this->price*(1 - ($this->discount/100));
    }
}
