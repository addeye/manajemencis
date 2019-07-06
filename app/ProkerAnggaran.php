<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProkerAnggaran extends Model {
	protected $table = 'proker_anggaran';

	public function proker_konsultans() {
		return $this->belongsTo('App\Proker_konsultan', 'proker_konsultans_id');
	}

	public function anggaran() {
		return $this->belongsTo('App\Anggaran', 'anggaran_id');
	}
}
