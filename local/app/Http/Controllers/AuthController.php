<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 24/01/2017
 * Time: 1:30
 */

namespace App\Http\Controllers;


use App\Repositories\AuthRepository;
use App\Repositories\BannerRepository;
use App\Repositories\KegiatanKonsultanRepository;
use App\Repositories\PengumumanRepository;
use App\Repositories\ProkerKonsultanRepository;
use App\Repositories\SentraKumkmRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $auth;
    protected $sentra;
    protected $kegiatan;
    protected $proker;
    protected $banner;
    protected $pengumuman;

    public function __construct(AuthRepository $auth,
                                SentraKumkmRepository $sentraKumkmRepository,
                                ProkerKonsultanRepository $prokerKonsultanRepository,
                                KegiatanKonsultanRepository $kegiatanKonsultanRepository,
                                BannerRepository $bannerRepository, PengumumanRepository $pengumumanRepository)
    {
        $this->auth = $auth;
        $this->sentra = $sentraKumkmRepository;
        $this->kegiatan = $kegiatanKonsultanRepository;
        $this->proker = $prokerKonsultanRepository;
        $this->banner = $bannerRepository;
        $this->pengumuman = $pengumumanRepository;
    }

    public function beranda()
    {
        $data=array
        (
            'jml_sentra' => count($this->sentra->getAll()),
            'jml_proker' => count($this->proker->getAll()),
            'jml_kegiatan' => count($this->kegiatan->getAll()),
            'jml_penerima' => $this->kegiatan->jmlPesertaKegiatan(),
            'banner' => $this->banner->getAll(),
            'pengumuman' => $this->pengumuman->getAll()
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

        $rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );

        $message = array(
            'email.required' => 'Email harus di isi',
            'email.email' => 'Pastikan email anda benar',
            'password.required' => 'Password tidak boleh kosong'
        );

        $validator = Validator::make($data,$rules,$message);
        if($validator->fails())
        {
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }

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