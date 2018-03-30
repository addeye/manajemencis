<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelaksanaanPendampingan extends Model {
	protected $table = 'pelaksanaan_pendampingan';

	public function program_kerja() {
		return $this->belongsTo('App\ProgramKerja', 'program_kerja_id');
	}

	public function konsultans() {
		return $this->belongsTo('App\Konsultan', 'konsultan_id');
	}

	public function lembaga() {
		return $this->belongsTo('App\Cis_lembaga', 'lembaga_id');
	}
}
