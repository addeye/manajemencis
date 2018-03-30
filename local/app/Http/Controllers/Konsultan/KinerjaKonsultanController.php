<?php

namespace App\Http\Controllers\Konsultan;

use App\Bidang_layanan;
use App\Http\Controllers\Controller;
use App\KinerjaKeterangan;
use App\KinerjaMaster;
use App\StandartLayanan;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KinerjaKonsultanController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$user = Auth::user();

		$kinerjamaster = KinerjaMaster::with('standart_layanan', 'lembaga')->where('cis_lembaga_id', $user->konsultans->lembaga_id)->get();

		$data = array(
			'title' => 'Daftar Kinerja',
			'data' => $kinerjamaster,
		);
		return view('dashboard.konsultan.kinerja.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$user = Auth::user();
		$lembaga_id = $user->konsultans->lembaga_id;
		$data = array(
			'title' => 'Tambah Kinerja',
			'bidanglayanan' => Bidang_layanan::all(),
			'lembaga_id' => $lembaga_id,
		);
		// return $data;
		return view('dashboard.konsultan.kinerja.add', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		// return $request->all();
		foreach ($request->standart_layanan_id as $key => $value) {
			if ($request->kinerja_id[$key] != '') {
				$kinerja = KinerjaMaster::find($request->kinerja_id[$key]);
				$kinerja->sasaran = $request->sasaran[$key];
				$kinerja->target = $request->target[$key];
				$kinerja->triwulan1 = $request->triwulan1[$key];
				$kinerja->triwulan2 = $request->triwulan2[$key];
				$kinerja->triwulan3 = $request->triwulan3[$key];
				$kinerja->triwulan4 = $request->triwulan4[$key];
				$kinerja->update();
			} else {
				$kinerja = new KinerjaMaster();
				$kinerja->cis_lembaga_id = $request->cis_lembaga_id;
				$kinerja->standart_layanan_id = $request->standart_layanan_id[$key];
				$kinerja->tahun = $request->tahun;
				$kinerja->sasaran = $request->sasaran[$key];
				$kinerja->target = $request->target[$key];
				$kinerja->triwulan1 = $request->triwulan1[$key];
				$kinerja->triwulan2 = $request->triwulan2[$key];
				$kinerja->triwulan3 = $request->triwulan3[$key];
				$kinerja->triwulan4 = $request->triwulan4[$key];
				$kinerja->save();
			}
		}

		$kinerja_keterangan = KinerjaKeterangan::where('cis_lembaga_id', $request->cis_lembaga_id)->where('tahun', $request->tahun)->first();
		if (count($kinerja_keterangan) == 0) {
			$kinerja_keterangan = new KinerjaKeterangan();
		}

		$kinerja_keterangan->tahun = $request->tahun;
		$kinerja_keterangan->cis_lembaga_id = $request->cis_lembaga_id;
		$kinerja_keterangan->keterangan = $request->kinerja_keterangan;
		$kinerja_keterangan->save();

		return redirect('kinerja-konsultan')->with('success', 'Data Kinerja Berhasil Disimpan');
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
		$row = KinerjaMaster::find($id);
		$data = array(
			'title' => 'Edit Kinerja',
			'bidanglayanan' => Bidang_layanan::all(),
			'standart_layanan' => StandartLayanan::where('bidang_layanan_id', $row->standart_layanan->bidang_layanan->id)->get(),
			'data' => $row,
		);
		// return $data;
		return view('dashboard.konsultan.kinerja.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$kinerja = KinerjaMaster::find($id);
		$kinerja->standart_layanan_id = $request->standart_layanan_id;
		$kinerja->sasaran = $request->sasaran;
		$kinerja->target = $request->target;
		$kinerja->tahun = $request->tahun;
		$kinerja->triwulan1 = $request->triwulan1;
		$kinerja->triwulan2 = $request->triwulan2;
		$kinerja->triwulan3 = $request->triwulan3;
		$kinerja->triwulan4 = $request->triwulan4;
		$kinerja->save();

		if ($kinerja) {
			return redirect('kinerja-konsultan')->with('success', 'Data Kinerja Berhasil Diupdate');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$result = KinerjaMaster::find($id);
		$result->delete();
	}

	public function getStandartLayanan($id) {
		echo '<option value=""">Pilih Layanan</option>';
		$standart_layanan = StandartLayanan::where('bidang_layanan_id', $id)->get();
		foreach ($standart_layanan as $value) {
			echo '<option value="' . $value->id . '">' . $value->nama . '</option>';
		}
	}

	public function getListStandartLayanan($tahun) {
		$user = Auth::user();
		$lembaga_id = $user->konsultans->lembaga_id;

		if ($tahun == '') {
			echo "Data Kosong Tidak Ada Lembaga";
			return false;
		}
		$kinerja = DB::table('standart_layanan')
			->leftJoin('kinerja_master', function ($leftJoin) use ($lembaga_id, $tahun) {
				$leftJoin->on('standart_layanan.id', '=', 'kinerja_master.standart_layanan_id')
					->where('kinerja_master.cis_lembaga_id', $lembaga_id)
					->where('kinerja_master.tahun', $tahun);
			})
			->select('standart_layanan.*', 'kinerja_master.sasaran', 'kinerja_master.target', 'kinerja_master.triwulan1', 'kinerja_master.triwulan2', 'kinerja_master.triwulan3', 'kinerja_master.triwulan4', 'kinerja_master.id AS kinerja_id')->get();
		$keterangan_kinerja = KinerjaKeterangan::where('cis_lembaga_id', $lembaga_id)->where('tahun', $tahun)->first();
		$data = array(
			'kinerja' => $kinerja,
			'tahun' => $tahun,
			'lembaga_id' => $lembaga_id,
			'keterangan_kinerja' => $keterangan_kinerja,
		);
		// return $data;
		return view('dashboard.konsultan.kinerja.add_ajax', $data);
	}

	public function getListKinerja($tahun) {
		$user = Auth::user();
		$lembaga_id = $user->konsultans->lembaga_id;

		if ($tahun == '') {
			echo "Data Kosong Tidak Ada Lembaga";
			return false;
		}
		$kinerja = DB::table('standart_layanan')
			->leftJoin('kinerja_master', function ($leftJoin) use ($lembaga_id, $tahun) {
				$leftJoin->on('standart_layanan.id', '=', 'kinerja_master.standart_layanan_id')
					->where('kinerja_master.cis_lembaga_id', $lembaga_id)
					->where('kinerja_master.tahun', $tahun);
			})
			->select('standart_layanan.*', 'kinerja_master.sasaran', 'kinerja_master.target', 'kinerja_master.triwulan1', 'kinerja_master.triwulan2', 'kinerja_master.triwulan3', 'kinerja_master.triwulan4', 'kinerja_master.id AS kinerja_id')->get();
		$row_percent = array();

		foreach ($kinerja as $key => $value) {
			$total = $value->triwulan1 + $value->triwulan2 + $value->triwulan3 + $value->triwulan4;

			$kinerja[$key]->total = $total;

			$percent = 0;

			if ($total != 0 && $value->target != 0) {
				$percent = ($total / $value->target) * 100;
			}

			$kinerja[$key]->percent = $percent;

			if ($value->target != '') {
				$row_percent[] = $percent;
			}
		}

		if (count($row_percent) > 0) {
			$rata_percent = array_sum($row_percent) / count($row_percent);
		} else {
			$rata_percent = 0;
		}

		$predikat = '';

		if ($rata_percent > 0 && $rata_percent <= 60) {
			$predikat = 'Kurang Baik';
		} elseif ($rata_percent > 60 && $rata_percent <= 80) {
			$predikat = 'Baik';
		} elseif ($rata_percent > 80 && $rata_percent <= 100) {
			$predikat = 'Sangat Baik';
		}

		$keterangan_kinerja = KinerjaKeterangan::where('cis_lembaga_id', $lembaga_id)->where('tahun', $tahun)->first();

		$data = array(
			'kinerja' => $kinerja,
			'tahun' => $tahun,
			'lembaga_id' => $lembaga_id,
			'rata_percent' => $rata_percent,
			'predikat' => $predikat,
			'keterangan_kinerja' => $keterangan_kinerja,
		);
		// return $data;
		return view('dashboard.konsultan.kinerja.list_ajax', $data);
	}
}
