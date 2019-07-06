<?php

namespace App\Http\Controllers\Admin;

use App\Anggaran;
use App\Http\Controllers\Controller;
use App\ProkerAnggaran;
use App\Proker_konsultan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProkerPlutController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$user = Auth::user();

		$data = array(
			'title' => 'PROGRAM KERJA PLUT KUMKM',
			'data' => Proker_konsultan::where('lembaga_id', $user->adminlembagas->lembaga_id)->get(),
		);
		return view('dashboard.admin.proker_plut.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$data = array(
			'title' => 'Add Kinerja',
			'anggaran' => Anggaran::all(),
		);

		return view('dashboard.admin.proker_plut.add', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$user = Auth::user();
		$data = $request->all();
		$rules = [
			'tahun' => 'required',
			'kegiatan' => 'required|max:255',
			'tujuan' => 'required|max:255',
			'sasaran' => 'required',
			'jumlah_sasaran' => 'required|numeric',
			'indikator' => 'required',
			'output' => 'required',
			'anggaran' => 'required|array|min:1',
		];

		$messages = [
			'tahun.required' => 'Tahun tidak boleh kosong',
			'kegiatan.required' => 'Kegiatan tidak boleh kosong',
			'kegiatan.max' => 'Kegiatan max 255 karakter',
			'tujuan.required' => 'Tujuan tidak boleh kosong',
			'tujuan.max' => 'Tujuan max 255 karakter',
			'sasaran.required' => 'Sasaran tidak boleh kosong',
			'jumlah_sasaran.required' => 'Sasaran tidak boleh kosong',
			'jumlah_sasaran.numeric' => 'Sasaran harus angka',
			'indikator.required' => 'Indikator tidak boleh kosong',
			'output.required' => 'Output tidak boleh kosong',
			'anggaran.required' => 'Anggaran harus terisi',
		];
		$validator = Validator::make($data, $rules, $messages);
		if ($validator->fails()) {
			return redirect('adm/proker-plut/create')->withErrors($validator)->withInput();
		}

		$data = new Proker_konsultan();
		$data->lembaga_id = $user->adminlembagas->lembaga_id;
		$data->tahun_kegiatan = $request->tahun;
		$data->program = $request->kegiatan;
		$data->tujuan = $request->tujuan;
		$data->sasaran = $request->sasaran;
		$data->jumlah_sasaran = $request->jumlah_sasaran;
		$data->indikator = $request->indikator;
		$data->output = $request->output;
		$data->save();

		if ($data) {
			foreach ($request->anggaran as $row) {
				$anggaran = new ProkerAnggaran();
				$anggaran->proker_konsultans_id = $data->id;
				$anggaran->anggaran_id = $row;
				$anggaran->save();
			}
		}

		if ($data) {
			return redirect('adm/proker-plut/create')->with('success', 'Data Proker Plut Berhasil Disimpan');
		}

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

		$data = Proker_konsultan::find($id);

		if ($data->status_lock == 'Yes') {
			return redirect('adm/proker-plut')->with('info', 'Data Proker Sudah di Lock, Hubungi Administrator jika ingin mengganti');
		}

		$data = array(
			'title' => 'Edit Kinerja',
			'anggaran' => Anggaran::all(),
			'data' => $data,
		);

		return view('dashboard.admin.proker_plut.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {

		$data = Proker_konsultan::find($id);

		if ($data->status_lock == 'Yes') {
			return redirect('adm/proker-plut')->with('info', 'Data Proker Sudah di Lock, Hubungi Administrator jika ingin mengganti');
		}

		$user = Auth::user();
		$data = $request->all();
		$rules = [
			'tahun' => 'required',
			'kegiatan' => 'required',
			'tujuan' => 'required',
			'sasaran' => 'required',
			'jumlah_sasaran' => 'required|numeric',
			'indikator' => 'required',
			'output' => 'required',
			'anggaran' => 'required|array|min:1',
		];

		$messages = [
			'tahun.required' => 'Tahun tidak boleh kosong',
			'kegiatan.required' => 'Kegiatan tidak boleh kosong',
			'tujuan.required' => 'Tujuan tidak boleh kosong',
			'sasaran.required' => 'Sasaran tidak boleh kosong',
			'jumlah_sasaran.required' => 'Sasaran tidak boleh kosong',
			'jumlah_sasaran.numeric' => 'Sasaran harus angka',
			'indikator.required' => 'Indikator tidak boleh kosong',
			'output.required' => 'Output tidak boleh kosong',
			'anggaran.required' => 'Anggaran harus terisi',
		];
		$validator = Validator::make($data, $rules, $messages);
		if ($validator->fails()) {
			return redirect('adm/proker-plut/create')->withErrors($validator)->withInput();
		}

		$data = Proker_konsultan::find($id);
		$data->lembaga_id = $user->adminlembagas->lembaga_id;
		$data->tahun_kegiatan = $request->tahun;
		$data->program = $request->kegiatan;
		$data->tujuan = $request->tujuan;
		$data->sasaran = $request->sasaran;
		$data->jumlah_sasaran = $request->jumlah_sasaran;
		$data->indikator = $request->indikator;
		$data->output = $request->output;
		$data->save();

		if ($data) {

			ProkerAnggaran::where('proker_konsultans_id', $data->id)->delete();

			foreach ($request->anggaran as $row) {
				$anggaran = new ProkerAnggaran();
				$anggaran->proker_konsultans_id = $data->id;
				$anggaran->anggaran_id = $row;
				$anggaran->save();
			}
		}

		if ($data) {
			return redirect('adm/proker-plut')->with('success', 'Data Proker Plut Berhasil Diupdate');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$result = Proker_konsultan::find($id);
		$data = $result;

		if ($data->status_lock == 'Yes') {
			return redirect('adm/proker-plut')->with('info', 'Data Proker Sudah di Lock, Hubungi Administrator jika ingin mengganti');
		}

		ProkerAnggaran::where('proker_konsultans_id', $result->id)->delete();
		$result->delete();
		if ($result) {
			return redirect('adm/proker-plut')->with('info', 'Data Proker Berhasil Dihapus');
		}
	}

	public function report() {
		$user = Auth::user();
		$data = array(
			'title' => 'Report Kinerja',
			'data' => Proker_konsultan::where('lembaga_id', $user->adminlembagas->lembaga_id)->get(),
		);
		return view('dashboard.admin.proker_plut.report', $data);
	}

	public function doLock($id) {
		$data = Proker_konsultan::find($id);
		$data->status_lock = 'Yes';
		$data->save();
		if ($data) {
			return redirect('adm/proker-plut')->with('info', 'Data Proker Berhasil di lock');
		}
	}
}
