<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KoperasiDetail extends Model {
	protected $table = 'koperasi_detail';

	public function koperasi() {
		return $this->belongsTo('App\Koperasi', 'koperasi_id');
	}
}
