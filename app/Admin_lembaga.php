<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin_lembaga extends Model {
	protected $table = 'admin_lembagas';

	protected $fillable = [
		'user_id',
		'nama_lengkap',
		'lembaga_id',
		'no_telp',
		'email',
	];

	public function users() {
		return $this->belongsTo(User::class, 'user_id');
	}

	public function lembagas() {
		return $this->belongsTo(Cis_lembaga::class, 'lembaga_id');
	}
}
