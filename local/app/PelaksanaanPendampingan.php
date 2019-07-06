<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelaksanaanPendampingan extends Model
{
    protected $table = 'pelaksanaan_pendampingan';

    protected $appends = ['kumkm_id', 'kumkm_type', 'sasaran_id'];

    public function getKumkmIdAttribute()
    {
        $pk = ProgramKerja::find($this->program_kerja_id);
        $sp = SasaranProgram::find($pk->sasaran_program_id);
        if ($sp) {
            return $sp->ukmtable_id;
        }
        return '';
    }

    public function getKumkmTypeAttribute()
    {
        $pk = ProgramKerja::find($this->program_kerja_id);
        $sp = SasaranProgram::find($pk->sasaran_program_id);
        if ($sp) {
            return $sp->ukmtable_type;
        }
        return '';
    }

    public function getSasaranIdAttribute()
    {
        $pk = ProgramKerja::find($this->program_kerja_id);
        $sp = SasaranProgram::find($pk->sasaran_program_id);
        if ($sp) {
            return $sp->id;
        }
        return '';
    }

    public function program_kerja()
    {
        return $this->belongsTo('App\ProgramKerja', 'program_kerja_id');
    }

    public function konsultans()
    {
        return $this->belongsTo('App\Konsultan', 'konsultan_id');
    }

    public function lembaga()
    {
        return $this->belongsTo('App\Cis_lembaga', 'lembaga_id');
    }
}
