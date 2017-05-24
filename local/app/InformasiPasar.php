<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class InformasiPasar extends Model
{
    protected $table = 'informasi_pasar';

    protected $fillable = [
        'nama_lengkap','email','telp',
        'perusahaan','jenis','nama_produk',
        'jumlah_produk','satuan_produk','harga_produk',
        'spesifikasi','keterangan','link'
    ];

    public function comment()
    {
        return $this->hasMany(CommentPasar::class,'informasi_pasar_id');
    }

    protected $appends = array('dibuat');

    public function getDibuatAttribute()
    {
        Carbon::setLocale('id');
        return $this->created_at->diffForHumans();
    }
}
