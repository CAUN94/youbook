<?php

namespace App\Models;

use App\Models\Action;
use App\Models\Kam;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserApp extends Authenticatable {
	use Notifiable;
	protected $table = 'usersapp';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'rut',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function roles() {
		return $this->belongsToMany(Role::class)->withTimestamps();
	}

	public function kams() {
		return $this->hasMany(Kam::class, 'userapp_id', 'id');
	}

	public function kamsCalculate($type) {
		$kams_array = $this->kams()->pluck('alliance')->toArray();
		$kams_array_implode = implode("','", $kams_array);

		$action = new Action();
		if ($type == "actual-month") {
			$firstday = Carbon::create(null, null, 21, 00, 00, 01);
			$lastday = Carbon::create(null, null, 20, 23, 55, 55);
			if (date('d') < 22) {
				$firstday->subMonth();
			} else {
				$lastday->addMonth();
			}
			$diff = 4;
		} elseif ($type == "last-month") {
			$firstday = Carbon::create(null, null, 21, 00, 00, 01);
			$lastday = Carbon::create(null, null, 20, 23, 55, 55);
			if (date('d') < 22) {
				$firstday->subMonth()->subMonth();
				$lastday->subMonth();
			} else {
				$firstday->subMonth();
			}
			$diff = 4;
		} elseif ($type == "last-week") {
			$firstday = Carbon::create(null, null, null, 0, 0, 1)->subWeek()->startOfWeek();
			$lastday = Carbon::create(null, null, null, 23, 55, 55)->subWeek()->startOfWeek()->addDay(6);
			$diff = 1;
		} elseif ($type == "month") {
			$firstday = Carbon::create(null, null, null, 0, 0, 1)->startOfMonth()->startOfWeek();
			$lastday = Carbon::create(null, null, null);
			$diff = 1;
		} else {
			return false;
		}
		$kams = $action->kams($firstday, $lastday, $kams_array_implode);
		$convenios = [];
		foreach ($kams as $key => $kam) {
			$convenios[] = $kam->Convenio;
		}
		$convenios = array_unique($convenios);
		$resumen = [];
		foreach ($convenios as $key => $convenio) {
			$info = [];
			$sum = 0;
			foreach ($kams as $key => $kam) {
				$sum += $kam->Precio_Prestacion;
			}
			$info[] = $convenio;
			$info[] = $sum;
			$resumen[] = $info;
		}
		return $resumen;

	}

	public function authorizeRoles($roles) {
		abort_unless($this->hasAnyRole($roles), 401);
		return true;
	}
	public function hasAnyRole($roles) {
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
	public function hasRole($role) {
		if ($this->roles()->where('name', $role)->first()) {
			return true;
		}
		return false;
	}

}
