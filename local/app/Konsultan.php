<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsultan extends Model
{
    protected $table = 'konsultans';

    protected $fillable = [
        'user_id',
        'no_registrasi',
        'nama_lengkap',
        'provinces_id',
        'regency_id',
        'alamat',
        'kode_pos',
        'jenis_kelamin',
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
        'ijazah',
        'sertifikat_1',
        'sertifikat_2',
        'pas_photo',
        'scan_ktp',
    ];

    public function prokers()
    {
        return $this->hasMany(Proker_konsultan::class,'konsultan_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($konslutan) {
            $konslutan->prokers()->delete();
        });
    }

    public function provinces()
    {
        return $this->belongsTo(Provinces::class,'provinces_id');
    }

    public function regencies()
    {
        return $this->belongsTo(Regencies::class,'regency_id');
    }

    public function pendidikans()
    {
        return $this->belongsTo(Pendidikans::class,'pendidikan_id');
    }

    public function lembagas()
    {
        return $this->belongsTo(Cis_lembaga::class,'lembaga_id');
    }

    public function bidang_layanans()
    {
        return $this->belongsTo(Bidang_layanan::class,'bidang_layanan_id');
    }
}
