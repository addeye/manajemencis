<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 24/01/2017
 * Time: 1:30
 */

namespace App\Http\Controllers;


use App\Repositories\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(AuthRepository $auth)
    {
        $this->auth = $auth;
    }

    public function login()
    {
        return view('login');
    }

    public function dologin(Request $request)
    {
        $data = array(
            'email' => $request->email,
            'password' => $request->password
        );
        if($this->auth->getCheckUser($data))
        {
            return redirect()->intended('home');
        }
        return redirect('/')->with('message','Username and Password Invalid');
    }

    public function logout()
    {
        $this->auth->logout();
        redirect('/');
    }
}