<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 16/02/2017
 * Time: 13:40
 */
if(! function_exists('public_upload'))
{
    function public_upload($path = '')
    {
        return app()->make('path').$path;
    }
}