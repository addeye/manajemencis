<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'id',
        'regency_id',
        'name'
    ];

    public $timestamps = false;

    public function regencies()
    {
        return $this->belongsTo('App\Regencies','regency_id');
    }
}
