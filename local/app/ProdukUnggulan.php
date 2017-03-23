<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukUnggulan extends Model
{
    protected $table = 'produk_unggulan';

    protected $fillable = [
        'nama_produk','merek','bidang_usaha','satuan','kapasitas_perbulan','omset_perbulan',
        'nama_pemilik','nama_perusahaan','alamat','provinces_id','regency_id','telp','email',
        'sentra','sentra_id','legalitas'
    ];
}
