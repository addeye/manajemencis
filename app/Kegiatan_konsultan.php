<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan_konsultan extends Model
{
    protected $table = 'kegiatan_konsultans';

    protected $fillable = [
        'konsultan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'nama_kegiatan',
        'jenis_layanan_id',
        'bidang_usaha_id',
        'lokasi_kegiatan',
        'jumlah_peserta',
        'output',
        'sumber_daya',
        'mitra_kegiatan',
        'rencana_tindak_lanjut',
    ];

    public function jenis_layanans()
    {
        return $this->belongsTo(Jenis_layanan::class,'jenis_layanan_id');
    }

    public function bidang_usahas()
    {
        return $this->belongsTo(Bidang_usaha::class,'bidang_usaha_id');
    }
}
