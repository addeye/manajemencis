<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KegiatanKonsultanBidang extends Model {
	protected $table = 'kegiatan_konsultans_bidang';

	public function kegiatan_konsultan() {
		return $this->belongsTo('App\Kegiatan_konsultan', 'kegiatan_konsultan_id');
	}

	public function bidang_layanan() {
		return $this->belongsTo('App\Bidang_layanan', 'bidang_layanan_id');
	}
}
