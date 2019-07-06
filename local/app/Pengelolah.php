<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengelolah extends Model
{
    protected $table = 'pengelolah';

    public function users() {
		return $this->belongsTo(User::class, 'user_id');
	}

	public function lembagas() {
		return $this->belongsTo(Cis_lembaga::class, 'lembaga_id');
	}
}
