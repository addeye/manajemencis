<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CommentPasar extends Model
{
    protected $table = 'comment_pasar';

    protected $fillable = [
        'informasi_pasar_id','nama','email','komentar'
    ];

    protected $appends = array('dibuat');

    public function getDibuatAttribute()
    {
        Carbon::setLocale('id');
        return $this->created_at->diffForHumans();
    }
}
