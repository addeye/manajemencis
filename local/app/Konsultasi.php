<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $table = 'konsultasi';

    protected $fillable = [
        'nama','email','telp','alamat','produk','permasalahan_bisnis','lembaga_id','respon','user_id'
    ];

    protected $appends = array('dibuat','diupdate');

    public function getDibuatAttribute()
    {
        Carbon::setLocale('id');
        return $this->created_at->diffForHumans();
    }

    public function getDiupdateAttribute()
    {
        Carbon::setLocale('id');
        return $this->updated_at->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function lembaga()
    {
        return $this->belongsTo(Cis_lembaga::class,'lembaga_id');
    }
}
