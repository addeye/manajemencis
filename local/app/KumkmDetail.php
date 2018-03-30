<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KumkmDetail extends Model {

	protected $table = 'kumkm_detail';

	public function kumkm() {
		return $this->belongsTo('App\Kumkm', 'kumkm_id');
	}
}
