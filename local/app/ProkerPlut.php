<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProkerPlut extends Model {
	protected $table = 'proker_plut';

	public function proker_anggaran() {
		return $this->hasMany('App\ProkerAnggaran', 'proker_plut_id');
	}
}
