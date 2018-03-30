<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model {
	protected $table = 'program_kerja';

	public function sasaran_program() {
		return $this->belongsTo('App\SasaranProgram', 'sasaran_program_id');
	}

	public function bidang_layanan() {
		return $this->belongsTo('App\Bidang_layanan', 'bidang_layanan_id');
	}

	public function lembaga() {
		return $this->belongsTo('App\Cis_lembaga', 'lembaga_id');
	}
}
