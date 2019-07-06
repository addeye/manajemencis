<?php

namespace App\Http\Controllers\Konsultan;

use App\Cis_lembaga;
use App\Http\Controllers\Controller;
use App\KinerjaMaster;
use App\Konsultan;
use App\Kumkm;
use App\Proker_konsultan;
use App\Repositories\ProdukUnggulanRepository;
use App\Repositories\SentraKumkmRepository;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller {

	protected $sentrakumkm;
	protected $produk;

	public function __construct(SentraKumkmRepository $sentrakumkm, ProdukUnggulanRepository $produkUnggulanRepository) {
		$this->sentrakumkm = $sentrakumkm;
		$this->produk = $produkUnggulanRepository;
	}

	public function sentraumkm() {
		$data = array(
			'head_title' => 'Sentra UMKM',
			'title' => 'Laporan Sentra UMKM',
			'data' => $this->sentrakumkm->getSentraByKosultan(),
		);
		return view('sentra_kumkm.report', $data);
	}

	public function dataumkm() {
		$data = array(
			'title' => 'Data Kumkm',
			'lembaga' => Cis_lembaga::all(),
			'kumkm' => Kumkm::with('lembaga', 'provinces', 'regencies', 'districts', 'villages', 'sentra_kumkm', 'bidangusaha')->paginate(10),
		);
		return view('kumkm.report', $data);
	}

	public function produkumkm() {
		$data = Array
			(
			'head_title' => 'Laporan Produk Unggulan',
			'title' => 'Laporan Produk Unggulan',
			'produk' => $this->produk->getAll(),

		);

		return view('produk_unggulan.report', $data);
	}

	public function kinerjacis() {
		$user = Auth::user();

		$kinerjamaster = KinerjaMaster::with('standart_layanan', 'lembaga')->where('cis_lembaga_id', $user->konsultans->lembaga_id)->get();

		$data = array(
			'title' => 'Daftar Kinerja',
			'data' => $kinerjamaster,
		);
		// return $data;
		return view('dashboard.konsultan.laporan.kinerjacis', $data);
	}

	public function prokerkonsultan() {
		$user = Auth::user();

		$data = array(
			'title' => 'Proker Konsultan',
			'data' => Proker_konsultan::where('konsultan_id', $user->konsultans->id)->get(),
		);
		// return $data;
		return view('dashboard.konsultan.proker.list_laporan', $data);
	}

	public function kegiatankonsultan() {

		$user = Auth::user();

		$data = array(
			'title' => 'Daftar Kegiatan',
		);
		// return $data;

		return view('dashboard.konsultan.laporan_kegiatan', $data);

	}
}
