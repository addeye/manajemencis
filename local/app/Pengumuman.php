<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'user_id','judul','keterangan'
    ];

    protected $appends = array('dibuat');

    public function getDibuatAttribute()
    {
        Carbon::setLocale('id');
        return $this->created_at->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
