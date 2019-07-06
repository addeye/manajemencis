<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 24/01/2017
 * Time: 1:30
 */

namespace App\Http\Controllers;

use App\Bidang_layanan;
use App\Koperasi;
use App\Kumkm;
use App\PelaksanaanPendampingan;
use App\ProgramKerja;
use App\Repositories\AuthRepository;
use App\Repositories\BannerRepository;
use App\Repositories\KegiatanKonsultanRepository;
use App\Repositories\PengumumanRepository;
use App\Repositories\ProkerKonsultanRepository;
use App\Repositories\SentraKumkmRepository;
use App\SasaranProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ActivityLog;
use Auth;

class AuthController extends Controller {
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
		BannerRepository $bannerRepository, PengumumanRepository $pengumumanRepository) {
		$this->auth = $auth;
		$this->sentra = $sentraKumkmRepository;
		$this->kegiatan = $kegiatanKonsultanRepository;
		$this->proker = $prokerKonsultanRepository;
		$this->banner = $bannerRepository;
		$this->pengumuman = $pengumumanRepository;
	}

	public function beranda() {
		$data = array
			(
			'jml_kumkm' => Kumkm::count(),
			'jml_koperasi' => Koperasi::count(),
			'koperasi_dampingan' => SasaranProgram::where('ukmtable_type', 'koperasi')->count(),
			'umkm_dampingan' => SasaranProgram::where('ukmtable_type', 'kumkm')->count(),
			'program' => ProgramKerja::count(),
			'pelaksanaan' => PelaksanaanPendampingan::count(),
			'bidanglayanan' => Bidang_layanan::all(),
			'banner' => $this->banner->getAll(),
			'pengumuman' => $this->pengumuman->getAll(),
		);

		return view('beranda', $data);
	}

	public function login() {
		return view('login');
	}

	public function dologin(Request $request) {
		$data = array(
			'email' => $request->email,
			'password' => $request->password,
			'status' => 'aktif',
		);

		$rules = array(
			'email' => 'required|email',
			'password' => 'required',
		);

		$message = array(
			'email.required' => 'Email harus di isi',
			'email.email' => 'Pastikan email anda benar',
			'password.required' => 'Password tidak boleh kosong',
		);

		$validator = Validator::make($data, $rules, $message);
		if ($validator->fails()) {
			return redirect('login')
				->withErrors($validator)
				->withInput();
		}

		if ($this->auth->getCheckUser($data)) {
			$log = new ActivityLog();
			$log->user_id = Auth::user()->id;
			$log->info = 'Melakukan login';
			$log->save();
			return redirect()->intended('home');
		}
		return redirect()->back()->with('message', 'Username and Password Invalid');
	}

	public function logout() {
		$log = new ActivityLog();
		$log->user_id = Auth::user()->id;
		$log->info = 'Melakukan logout';
		$log->save();
		$this->auth->logout();
		return redirect('/');
	}
}