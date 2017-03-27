<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kumkm extends Model
{
    protected $table = 'kumkm';

    protected $fillable = [
        'nama_usaha','lembaga_id','nama_pemilik','id_kumkm','telp','no_ktp','npwp','email',
        'badan_usaha','ket_badan_usaha','tgl_mulai_usaha','bidang_usaha',
        'skala_usaha','usaha_utama','hasil_produk','sentra','sentra_id',
        'tk_tetap','tk_tidak_tetap','foto_usaha','provinces_id','regency_id',
        'district_id','village_id','alamat','kas_tunai','persediaan','harga_tetap',
        'kw_bank','kw_koperasi','kw_lainnya','kp_sertifikat','kp_tidak_sertifikat',
        'om_1thn_lalu','om_2thn_lalu','lb_1thn_lalu','lb_2thn_lalu','laporan_regular',
        'p1_nama_produk','p1_deskripsi','p1_harga','p1_foto_produk',
        'p2_nama_produk','p2_deskripsi','p2_harga','p2_foto_produk',
        'p3_nama_produk','p3_deskripsi','p3_harga','p3_foto_produk',
        'izin_produk','izin_usaha_iumk','izin_usaha_siui','izin_usaha_siup',
        'legalitas_lokasi','jangkauan_pasar','terima_pendampingan','masalah_lembaga','masalah_sdm',
        'masalah_produksi','masalah_pembiayaan','masalah_pemasaran','masalah_lainnya'
    ];

    public function provinces()
    {
        return $this->belongsTo(Provinces::class,'provinces_id');
    }

    public function regencies()
    {
        return $this->belongsTo(Regencies::class,'regency_id');
    }

    public function districts()
    {
        return $this->belongsTo(Districts::class,'district_id');
    }

    public function villages()
    {
        return $this->belongsTo(Villages::class,'village_id');
    }

    public function sentra_kumkm()
    {
        return $this->belongsTo(Sentra_kumkm::class,'sentra_id');
    }

    public function bidangusaha()
    {
        return $this->belongsTo(Bidang_usaha::class,'bidang_usaha');
    }
}
