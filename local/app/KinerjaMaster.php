<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KinerjaMaster extends Model
{
    protected $table = 'kinerja_master';

    public function standart_layanan()
    {
    	return $this->belongsTo('App\StandartLayanan','standart_layanan_id');
    }

    public function lembaga()
    {
    	return $this->belongsTo('App\Cis_lembaga','cis_lembaga_id');
    }
}
