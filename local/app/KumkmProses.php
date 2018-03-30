<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KumkmProses extends Model {
	protected $table = 'kumkm_proses';

	public function kumkm_naik() {
		return $this->belongsTo('App\KumkmNaik', 'kumkm_naik_id');
	}

	public function bidang_layanan() {
		return $this->belongsTo('App\bidang_layanan', 'bidang_layanan_id');
	}

	public function konsultan() {
		return $this->belongsTo('App\Konsultan', 'konsultan_id');
	}
}
