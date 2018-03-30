<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Details_proker extends Model {
	protected $table = 'details_prokers';

	protected $fillable = [
		'proker_id',
		'jenis_kegiatan',
		'jenis_layanan_id',
		'output',
		'ket_output',
		'jml_penerima',
		'anggaran',
		'tujuan',
		'sasaran',
		'indikator',
		'jadwal_pelaksana',
		'mitra_kerja',
		'konsultan_id',
	];

	protected $appends = array('jadwal');

	public function getJadwalAttribute() {
		return explode(", ", $this->jadwal_pelaksana);
	}

	public function konsultans() {
		return $this->belongsTo('App\Konsultan', 'konsultan_id');
	}

	public function prokers() {
		return $this->belongsTo(Proker_konsultan::class, 'proker_id');
	}

	public function jenis_layanans() {
		return $this->belongsTo(Jenis_layanan::class, 'jenis_layanan_id');
	}
}
