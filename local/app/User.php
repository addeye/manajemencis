<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'path', 'status',
    ];

    protected $appends = ['lembaga_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getLembagaIdAttribute()
    {
        if ($this->role_id == 1) {
            return 0;
        } elseif ($this->role_id == 2) {
            return $this->adminlembagas->lembaga_id;
        } elseif ($this->role_id == 3) {
            return $this->konsultans->lembaga_id;
        } elseif ($this->role_id == 5) {
            return $this->pengelolah->lembaga_id;
        }
        return 0;
    }

    public function roles()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    public function konsultans()
    {
        return $this->hasOne(Konsultan::class, 'user_id');
    }

    public function log()
    {
        return $this->hasMany('App\ActivityLog', 'user_id');
    }

    public function adminlembagas()
    {
        return $this->hasOne(Admin_lembaga::class, 'user_id');
    }

    public function pengelolah()
    {
        return $this->hasOne(Pengelolah::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->konsultans()->delete();
            $user->adminlembagas()->delete();
        });
    }
}
