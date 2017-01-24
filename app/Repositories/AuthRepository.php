<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 24/01/2017
 * Time: 1:24
 */

namespace App\Repositories;


use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    public function getCheckUser($data)
    {
        if(Auth::attempt($data))
        {
            return true;
        }
        return false;
    }

    public function logout()
    {
        if(Auth::logout())
        {
            return true;
        }
        return false;
    }
}