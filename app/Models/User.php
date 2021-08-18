<?php

namespace App\Models;

use App\Models\RoleApp;
use App\Models\Training;
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
        return $this->belongsToMany(Role::class)->first();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                 return true;
            }
        }
        return false;
    }

    public function student(){
        return $this->hasOne('App\Models\Student','user_id','id');
    }

    public function plan(){
        return Training::find($this->student->training_id);
    }

    public function dashboard(){
        if (Auth::user()->hasAnyRole(['administrador','entrenador','professional'])){
            return True;
        }else{
            return False;
        }
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function isProfessional(){
        if ($this->hasRole('profesional')){
            return True;
        }else{
            return False;
        }
    }

    public function isAdmin(){
        if ($this->hasRole('administrador')){
            return True;
        }else{
            return False;
        }
    }

    public function isTrainer(){
        if ($this->hasRole('entrenador')){
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

    public function image(){
        if ($this->image){
            return $this->image;
        }
        return 'logo-basic-naranjo.png';
    }



}
