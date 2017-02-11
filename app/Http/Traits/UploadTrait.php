<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 11/02/2017
 * Time: 12:53
 */

namespace App\Http\Traits;


use Carbon\Carbon;

trait UploadTrait
{
    public function upload_image($files,$dir,$old='')
    {
        //getting timestamp
        $timestamp = str_replace(['',':'],' pp -',Carbon::now()->toDateTimeString());
        $name = $timestamp.'-'.$files->getClientOriginalName();
        $files->move(public_path().'/'.$dir.'/',$name);
        if($old!='' and file_exists(public_path().'/'.$dir.'/'.$old))
        {
            unlink(public_path().'/'.$dir.'/'.$old);
        }
        return $name;
    }
}