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
        'bidang_usaha_id',
        'lokasi_kegiatan',
        'jumlah_peserta',
        'output',
        'sumber_daya',
        'mitra_kegiatan',
        'rencana_tindak_lanjut',
        'proker_id',
        'detail_proker_id',
    ];

    public function bidang_usahas()
    {
        return $this->belongsTo(Bidang_usaha::class,'bidang_usaha_id');
    }

    public function konsultan()
    {
        return $this->belongsTo(Konsultasi::class,'konsultan_id');
    }

    public function prokers()
    {
        return $this->belongsTo(Proker_konsultan::class,'proker_id');
    }

    public function detail_proker()
    {
        return $this->belongsTo(Details_proker::class,'detail_proker_id');
    }
}
