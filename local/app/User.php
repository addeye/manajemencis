<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'role_id', 'path', 'status',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function roles() {
		return $this->belongsTo(Roles::class, 'role_id');
	}

	public function konsultans() {
		return $this->hasOne(Konsultan::class, 'user_id');
	}

	public function adminlembagas() {
		return $this->hasOne(Admin_lembaga::class, 'user_id');
	}

	protected static function boot() {
		parent::boot();

		static::deleting(function ($user) {
			$user->konsultans()->delete();
			$user->adminlembagas()->delete();
		});
	}
}
