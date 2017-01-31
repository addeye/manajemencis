<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regencies extends Model
{
    protected $table = 'regencies';

    protected $fillable = ['id','province_id','name'];

    public $timestamps = false;

    public function provinces()
    {
        return $this->belongsTo('App\Provinces','province_id');
    }
}
