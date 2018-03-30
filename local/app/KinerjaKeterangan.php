<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KinerjaKeterangan extends Model {
	protected $table = 'kinerja_keterangan';

	public function lembaga() {
		return $this->belongsTo('App\Cis_lembaga', 'cis_lembaga_id');
	}
}
