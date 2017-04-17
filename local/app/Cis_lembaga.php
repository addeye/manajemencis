<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cis_lembaga extends Model
{
    protected $table = 'cis_lembagas';

    protected $fillable = [
        'id_lembaga',
        'provinces_id',
        'regency_id',
        'plut_name',
        'plut_bentuk_kelembagaan',
        'plut_alamat',
        'plut_telp',
        'plut_email',
        'plut_whatsapp',
        'plut_website',
        'plut_facebook',
        'skpd_name',
        'skpd_alamat',
        'skpd_telp',
        'skpd_email',
        'skpd_whatsapp',
        'tahun_perolehan',
        'mulai_operasional',
        'tgl_peresmian',
        'diresmikan_oleh',
        'hibah_tahun',
        'ket_bersinergi',
        'produk_unggulan',
        'pemasaran',
        'produk_potensial',
        'jml_umkm_ecommarce',
        'jml_produk_online',
        'photo_gedung',
    ];

    public function sentra_binaan()
    {
        return $this->hasMany(Sentra_binaan::class,'cis_lembaga_id');
    }

    public function sentra_kumkm()
    {
        return $this->hasMany(Sentra_kumkm::class,'id_lembaga');
    }

    public function cis_filemanager()
    {
        return $this->hasMany(Cis_filemanager::class,'cis_lembaga_id');
    }

    public function provinces()
    {
        return $this->belongsTo(Provinces::class,'provinces_id');
    }

    public function regencies()
    {
        return $this->belongsTo(Regencies::class,'regency_id');
    }

    public function konsultan()
    {
        return $this->hasMany(Konsultan::class,'lembaga_id');
    }
}
