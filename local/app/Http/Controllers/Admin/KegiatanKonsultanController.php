<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kegiatan_konsultan;
use App\Konsultan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class KegiatanKonsultanController extends Controller {

	public function index() {
		$user = Auth::user();

		$data = array(
			'title' => 'Daftar Kegiatan',
			'konsultan' => Konsultan::where('lembaga_id', $user->adminlembagas->lembaga_id)->get(),
		);
		// return $data;

		return view('dashboard.admin.kegiatan.list', $data);
	}

	public function getKegiatanKonsultan() {
		$konsultan_id = Input::get('konsultan_id');
		$tahun = Input::get('tahun');

		$data = array(
			'kegiatan' => Kegiatan_konsultan::where('konsultan_id', $konsultan_id)->whereYear('tanggal_mulai', $tahun)->get(),
		);
		// return $data;

		return view('dashboard.admin.kegiatan.list_ajax', $data);
	}
}
