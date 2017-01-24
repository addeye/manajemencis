<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    protected $table = 'lemabagas';

    protected $fillable = [
        'name',
        'tingkat_id',
        'district_id',
        'alamat',
        'kode_pos',
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
        'nama_kons_kelembagaan',
        'telepon_kons_kelembagaan',
        'email_kons_kelembagaan',
        'nama_kons_sdm',
        'telepon_kons_sdm',
        'email_kons_sdm',
        'nama_kons_produksi',
        'telepon_kons_produksi',
        'email_kons_produksi',
        'nama_kons_pembiayaan',
        'telepon_kons_pembiayaan',
        'email_kons_pembiayaan',
        'nama_kons_pemasaran',
        'telepon_kons_pemasaran',
        'email_kons_pemasaran',
        'nama_kons_it',
        'telepon_kons_it',
        'email_kons_it',
        'nama_kons_kerjasama',
        'telepon_kons_kerjasama',
        'email_kons_kerjasama',
    ];
}
