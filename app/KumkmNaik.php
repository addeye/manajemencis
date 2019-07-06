<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KumkmNaik extends Model {
	protected $table = 'kumkm_naik';

	public function kumkm() {
		return $this->belongsTo('App\Kumkm', 'kumkm_id');
	}

	public function kumkm_proses() {
		return $this->hasMany('App\KumkmProses', 'kumkm_naik_id');
	}

	public function lembaga() {
		return $this->belongsTo('App\Cis_lembaga', 'lembaga_id');
	}

	public function konsultan() {
		return $this->belongsTo('App\Konsultan', 'konsultan_id');
	}
}
