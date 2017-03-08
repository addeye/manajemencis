<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'user_id','judul','keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
