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
        $from = Carbon::now()->startOfWeek()->format('Y-m-d');
        $to = Carbon::now()->endOfWeek()->format('Y-m-d');
        return $this->hasMany(TrainAppointments::class)->whereBetween('date', [$from, $to]);
    }
}
