<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan_konsultan_file extends Model {
	protected $table = 'kegiatan_konsultan_file';

	public function kegiatan_konsultan() {
		return $this->belongsTo('App/Kegiatan_konsultan', 'kegiatan_konsultan_id');
	}
}
