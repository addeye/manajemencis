<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    protected $table = 'lembagas';

    protected $fillable = [
        'idlembaga',
        'name',
        'tingkat_id',
        'provinces_id',
        'regency_id',
        'alamat',
        'kode_pos',
        'bentuk_lembaga',
        'SKPD',
        'tahun_berdiri',
        'telepon',
        'email',
        'nama_pimpinan',
        'telepon_pimpinan',
        'email_pimpinan',
        'nama_admin',
        'telepon_admin',
        'email_admin',
        'nama_staffgalery',
        'telepon_staffgalery',
        'email_staffgalery',
        'nama_staffteknis',
        'telepon_staffteknis',
        'email_staffteknis',
    ];

    public function provinces()
    {
        return $this->belongsTo(Provinces::class,'provinces_id');
    }

    public function regencies()
    {
        return $this->belongsTo(Regencies::class,'regency_id');
    }

    public function tingkats()
    {
        return $this->belongsTo(Tingkats::class,'tingkat_id');
    }
}
