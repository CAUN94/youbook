<?php

namespace App\Models;

use App\Models\RoleApp;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastnames',
        'rut',
        'email',
        'password',
        'gender',
        'rut',
        'gender',
        'role_id',
        'address',
        'phone',
        'department',
        'image',
        'education',
        'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->hasOne('App\Models\Role','id','role_id');
    }

    public function student(){
        return $this->hasOne('App\Models\Student','user_id','id');
    }

    public function dashboard(){
        if (Auth::user()->role->name != 'paciente'){
            return True;
        }else{
            return False;
        }
    }

    public function isProfessional(){
        if ($this->role->name == 'profesional'){
            return True;
        }else{
            return False;
        }
    }

    public function isAdmin(){
        if ($this->role->name == 'administrador'){
            return True;
        }else{
            return False;
        }
    }

    public function isTrainer(){
        if ($this->role->name == 'entrenador'){
            return True;
        }else{
            return False;
        }
    }

    public function isStudent(){
        if ($this->student != Null){
            return True;
        }else{
            return False;
        }
    }

    public function userAvatar($request){
        $image = $request->file('image');
        $name = $image->hashName();
        $destination = public_path('/img/professionals/');
        $image->move($destination,$name);
        return $name;

    }

    public function Calendar() {
      return $this->hasMany('App\Models\Calendar');
    }


    public function classesStatus($bookId){
        $train = BookingTrain::where('user_id',$this->id)->where('train_appointment_id',$bookId)->first();
        return $train;
    }

    public function medilinkname(){
        return UserApp::where('rut',Auth::user()->rut)->first()->medilinkname;
    }

    public function isSettled(){
        return $this->student->settled;
    }



}
