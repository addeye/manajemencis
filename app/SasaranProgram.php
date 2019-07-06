<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SasaranProgram extends Model
{
    protected $table = 'sasaran_program';

    protected $appends = ['nama_kumkm'];

    public function getNamaKumkmAttribute()
    {
        return $this->ukmtable->nama_kumkm;
    }

    public function ukmtable()
    {
        return $this->morphTo();
    }

    public function lembaga()
    {
        return $this->belongsTo('App\Cis_lembaga', 'lembaga_id');
    }

    public function program_kerja()
    {
        return $this->hasMany('App\ProgramKerja', 'sasaran_program_id');
    }

    public function pelaksanaan($bidang_id)
    {
        $program_id = $this->program_kerja()->where('bidang_layanan_id', $bidang_id)->pluck('id');
        return PelaksanaanPendampingan::whereIn('program_kerja_id', $program_id)->get();
    }

    public function pelaksanaanAll()
    {
        $program_id = $this->program_kerja()->pluck('id');
        return PelaksanaanPendampingan::whereIn('program_kerja_id', $program_id)->get();
    }
}
