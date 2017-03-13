<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentPasar extends Model
{
    protected $table = 'comment_pasar';

    protected $fillable = [
        'informasi_pasar_id','nama','email','komentar'
    ];
}
