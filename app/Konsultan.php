<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsultan extends Model
{
    protected $table = 'konsultans';

    protected $fillable = [
        'username',
        'no_registrasi',
        'nama_lengkap',
        'provinces_id',
        'regency_id',
        'alamat',
        'kode_pos',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'telepon',
        'email',
        'pendidikan_id',
        'perguruan_terakhir',
        'jurusan',
        'bidang_keahlian',
        'pengalaman',
        'sertifikat',
        'asosiasi',
        'lembaga_id',
        'bidang_layanan_id',
    ];
}
