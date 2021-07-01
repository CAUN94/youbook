<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = [];

   public function professional(){
  	return $this->belongsTo(User::class,'professional_id','id');
  }

   public function user(){
  	return $this->belongsTo(User::class,'user_id','id');
  }
}
