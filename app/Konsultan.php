<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsultan extends Model
{
    protected $table = 'konsultans';

    protected $fillable = [
        'username',
        'nama_lengkap',
        'district_id',
        'alamat',
        'kode_pos',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'telepon',
        'email',
        'pendidikan_id',
        'pengalaman',
        'lembaga_id',
        'bidang_layanan_id',
        'foto'
    ];
}
