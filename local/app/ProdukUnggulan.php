<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukUnggulan extends Model
{
    protected $table = 'produk_unggulan';

    protected $fillable = [
        'nama_produk','merek','bidang_usaha','satuan','kapasitas_perbulan','omset_perbulan',
        'nama_pemilik','nama_perusahaan','alamat','provinces_id','regency_id','telp','email',
        'sentra','sentra_id','legalitas','lembaga_id'
    ];

    public function bidangUsaha()
    {
        return $this->belongsTo(Bidang_usaha::class,'bidang_usaha');
    }

    public function lembaga()
    {
        return $this->belongsTo(Cis_lembaga::class,'lembaga_id');
    }

    public function provinces()
    {
        return $this->belongsTo(Provinces::class,'provinces_id');
    }

    public function regencies()
    {
        return $this->belongsTo(Regencies::class,'regency_id');
    }

    public function sentra_kumkm()
    {
        return $this->belongsTo(Sentra_kumkm::class,'sentra_id');
    }
}
