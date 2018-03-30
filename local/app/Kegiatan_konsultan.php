<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan_konsultan extends Model {
	protected $table = 'kegiatan_konsultans';

	protected $fillable = [
		'konsultan_id',
		'tanggal_mulai',
		'tanggal_selesai',
		'bidang_usaha_id',
		'lokasi_kegiatan',
		'jumlah_peserta',
		'output',
		'sumber_daya',
		'mitra_kegiatan',
		'rencana_tindak_lanjut',
		'proker_id',
		'detail_proker_id',
		'judul_kegiatan',
		'ket_output',
		'image',
		'bidang_layanan_id',
	];

	protected $appends = ['tahun'];

	public function getTahunAttribute() {
		return date('Y', strtotime($this->created_at));
	}

	public function bidang_usahas() {
		return $this->belongsTo(Bidang_usaha::class, 'bidang_usaha_id');
	}

	public function bidang_layanan() {
		return $this->belongsTo(Bidang_layanan::class, 'bidang_layanan_id');
	}

	public function konsultan() {
		return $this->belongsTo(Konsultan::class, 'konsultan_id');
	}

	public function prokers() {
		return $this->belongsTo(Proker_konsultan::class, 'proker_id');
	}

	public function detail_proker() {
		return $this->belongsTo(Details_proker::class, 'detail_proker_id');
	}

	public function kegiatan_konsultan_bidang() {
		return $this->hasMany('App\KegiatanKonsultanBidang', 'kegiatan_konsultan_id');
	}
}
