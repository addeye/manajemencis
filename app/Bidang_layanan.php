<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidang_layanan extends Model
{
    protected $table = 'bidang_layanans';

    protected $fillable = [
        'name'
    ];

    public function jenisLayanans()
    {
        return $this->hasMany(Jenis_layanan::class,'bidang_layanan_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($bidangLayanan){
            $bidangLayanan->jenisLayanans()->delete();
        });
    }
}
