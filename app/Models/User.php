<?php

namespace App\Models;

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

    public function dashboard(){
        if (Auth::user()->role->name == 'administrador' || Auth::user()->role->name == 'profesional'){
            return True;
        }else{
            return False;
        }
    }

    public function isProfessional(){
        if (Auth::user()->role->name == 'profesional'){
            return True;
        }else{
            return False;
        }
    }

    public function isAdmin(){
        if (Auth::user()->role->name == 'administrador'){
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
}
