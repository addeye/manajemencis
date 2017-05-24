<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Villages extends Model
{
    protected $table = 'villages';

    protected $fillable = ['id','district_id','name'];

    public $timestamps = false;

    public function districts()
    {
        return $this->belongsTo('App\Districts','district_id');
    }
}
