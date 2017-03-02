<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 24/01/2017
 * Time: 1:30
 */

namespace App\Http\Controllers;


use App\Repositories\AuthRepository;
use App\Repositories\KegiatanKonsultanRepository;
use App\Repositories\ProkerKonsultanRepository;
use App\Repositories\SentraKumkmRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $auth;
    protected $sentra;
    protected $kegiatan;
    protected $proker;

    public function __construct(AuthRepository $auth,
                                SentraKumkmRepository $sentraKumkmRepository,
                                ProkerKonsultanRepository $prokerKonsultanRepository,
                                KegiatanKonsultanRepository $kegiatanKonsultanRepository)
    {
        $this->auth = $auth;
        $this->sentra = $sentraKumkmRepository;
        $this->kegiatan = $kegiatanKonsultanRepository;
        $this->proker = $prokerKonsultanRepository;
    }

    public function beranda()
    {
        $data=array
        (
            'jml_sentra' => count($this->sentra->getAll()),
            'jml_proker' => count($this->proker->getAll()),
            'jml_kegiatan' => count($this->kegiatan->getAll()),
            'jml_penerima' => $this->kegiatan->jmlPesertaKegiatan(),
        );
        return view('beranda',$data);
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
        return redirect()->back()->with('message','Username and Password Invalid');
    }

    public function logout()
    {
        $this->auth->logout();
        return redirect('/');
    }
}