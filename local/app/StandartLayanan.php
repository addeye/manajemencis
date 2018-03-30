<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StandartLayanan extends Model
{
    protected $table = 'standart_layanan';

    public function bidang_layanan()
    {
    	return $this->belongsTo('App\Bidang_layanan','bidang_layanan_id');
    }
}
