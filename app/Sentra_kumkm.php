<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentra_kumkm extends Model
{
    protected $table = 'sentra_kumkms';

    protected $fillable = [
        'id_lembaga',
        'id_sentra',
        'name',
        'provinces_id',
        'regency_id',
        'district_id',
        'village_id',
        'alamat',
        'tahun_berdiri',
        'bidang_usaha_id',
        'total_umkm',
        'total_pegawai',
        'omset_bulan',
        'teknologi',
        'bahan_baku',
        'pemasaran',
        'kemitraan',
        'nama_ketua',
        'notelp_ketua',
        'email_ketua',
        'name_cp',
        'no_cp',
        'email_cp',
        'pembina_kementrian',
        'pembina_bidang',
        'pembina_tenaga_pendamping',
        'masalah_kelembagaan',
        'masalah_sdm',
        'masalah_produksi',
        'masalah_pembiayaan',
        'masalah_pemasaran',
    ];

    public function provinces()
    {
        return $this->belongsTo(Provinces::class,'provinces_id');
    }

    public function districts()
    {
        return $this->belongsTo(Districts::class,'district_id');
    }

    public function regencies()
    {
        return $this->belongsTo(Regencies::class,'regency_id');
    }

    public function villages()
    {
        return $this->belongsTo(Villages::class,'village_id');
    }

    public function bidang_usahas()
    {
        return $this->belongsTo(Bidang_usaha::class,'bidang_usaha_id');
    }

    public function lembagas()
    {
        return $this->belongsTo(Cis_lembaga::class,'id_lembaga');
    }
}
