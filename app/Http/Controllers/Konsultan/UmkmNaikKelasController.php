<?php

namespace App\Http\Controllers\Konsultan;

use App\Http\Controllers\Controller;
use App\Kumkm;
use App\KumkmNaik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UmkmNaikKelasController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}

	public function listUmkm() {
		$user = Auth::user();
		$umkm = KumkmNaik::where('lembaga_id', $user->konsultans->lembaga_id)->paginate();
		$data = array(
			'data' => $umkm,
		);
		return view('umkmnaikkelas.list_pendaftar', $data);
	}

	public function pendaftaranUmkm() {
		$user = Auth::user();

		$nama_input = Input::get('nama');

		$kumkm_naik = KumkmNaik::where('lembaga_id', $user->konsultans->lembaga_id)->where('tahun', date('Y'))->pluck('kumkm_id')->unique();

		$content = Kumkm::query();

		$content->where('lembaga_id', $user->konsultans->lembaga_id)->whereNotIn('id', $kumkm_naik);

		if (!is_null($nama_input)) {
			$content->where('nama_usaha', 'like', '%' . $nama_input . '%')->orWhere('nama_pemilik', 'like', '%' . $nama_input . '%');
		}

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'nama' => $nama_input,
		);
		return view('umkmnaikkelas.pendaftaran', $data);
	}

	public function doPendaftaranUmkm(Request $request) {
		return 'doPendaftaranUmkm';
	}

	public function doOnePendaftaranUmkm(Request $request, $id) {
		$user = Auth::user();
		$kumkm_naik = KumkmNaik::where('kumkm_id', $id)->count();
		if ($kumkm_naik == 0) {
			$data = new KumkmNaik;
			$data->kumkm_id = $id;
			$data->lembaga_id = $user->konsultans->lembaga_id;
			$data->konsultan_id = $user->konsultans->id;
			$data->tahun = date('Y');
			$data->save();

			if ($data) {
				return redirect('pendaftaran-umkm')->with('success', 'Umkm telah terdaftar');
			}
		}
		return redirect('pendaftaran-umkm')->with('info', 'Data KUMKM double');

	}

	public function deletePendaftaranUmkm($id) {
		$data = KumkmNaik::find($id);
		if (count($data->kumkm_proses) > 0) {
			return redirect('list-umkm')->with('info', 'Data KUMKM telah memiliki data proses');
		}
		$data->delete();
		return redirect('list-umkm')->with('success', 'Data Kumkm berhasil dihapus');
	}

	public function penilaian() {

	}

	public function doPenilaian(Request $request) {

	}
}
