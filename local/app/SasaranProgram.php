<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SasaranProgram extends Model {

	protected $table = 'sasaran_program';

	protected $appends = array('nama_kumkm');

	public function getNamaKumkmAttribute() {
		return $this->ukmtable->nama_kumkm;
	}

	public function ukmtable() {
		return $this->morphTo();
	}

	public function lembaga() {
		return $this->belongsTo('App\Cis_lembaga', 'lembaga_id');
	}
}
