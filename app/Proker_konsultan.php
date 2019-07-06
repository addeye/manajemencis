<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proker_konsultan extends Model {
	protected $table = 'proker_konsultans';

	public function details_proker() {
		return $this->hasMany(Details_proker::class, 'proker_id');
	}

	public function konsultan() {
		return $this->belongsTo('App\Konsultan', 'konsultan_id');
	}

	public function lembagas() {
		return $this->belongsTo('App\Cis_lembaga', 'lembaga_id');
	}

	public function proker_anggaran() {
		return $this->hasMany('App\ProkerAnggaran', 'proker_konsultans_id');
	}
}
