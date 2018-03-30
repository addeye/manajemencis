<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Koperasi extends Model {
	protected $table = 'koperasi';

	protected $appends = array('nama_kumkm');

	public function getNamaKumkmAttribute() {
		return $this->nama_koperasi;
	}

	public function lembaga() {
		return $this->belongsTo('App\Cis_lembaga', 'lembaga_id');
	}

	public function koperasi_detail() {
		return $this->hasMany('App\KoperasiDetail', 'koperasi_id');
	}

	public function regencies() {
		return $this->belongsTo(Regencies::class, 'regency_id');
	}

	public function ukm() {
		return $this->morphMany('App\SasaranProgram', 'ukmtable');
	}
}
