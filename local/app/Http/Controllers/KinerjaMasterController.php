<?php

namespace App\Http\Controllers;

use App\Bidang_layanan;
use App\Cis_lembaga;
use App\KinerjaKeterangan;
use App\KinerjaMaster;
use App\StandartLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KinerjaMasterController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$data = array(
			'title' => 'Daftar Kinerja',
			'data' => KinerjaMaster::with('standart_layanan', 'lembaga')->get(),
			'lembaga' => Cis_lembaga::all(),
		);
		return view('kinerja.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$data = array(
			'title' => 'Add/Edit Kinerja',
			'bidanglayanan' => Bidang_layanan::all(),
			// 'standart_layanan' => StandartLayanan::all(),
			'lembaga' => Cis_lembaga::orderBy('id', 'asc')->get(),
		);
		// return $data;
		return view('kinerja.add', $data);
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

		return redirect('kinerja-master')->with('success', 'Data Kinerja Berhasil Disimpan');

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
			'lembaga' => Cis_lembaga::orderBy('id', 'asc')->get(),
			'standart_layanan' => StandartLayanan::where('bidang_layanan_id', $row->standart_layanan->bidang_layanan->id)->get(),
			'data' => $row,
		);
		// return $data;
		return view('kinerja.edit', $data);
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
		$kinerja->cis_lembaga_id = $request->cis_lembaga_id;
		$kinerja->triwulan1 = $request->triwulan1;
		$kinerja->triwulan2 = $request->triwulan2;
		$kinerja->triwulan3 = $request->triwulan3;
		$kinerja->triwulan4 = $request->triwulan4;
		$kinerja->save();

		if ($kinerja) {
			return redirect('kinerja-master')->with('success', 'Data Kinerja Berhasil Diupdate');
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

	public function report() {

	}

	public function getListStandartLayanan($lembaga_id, $tahun) {
		if ($lembaga_id == '') {
			echo "Data Kosong Tidak Ada Lembaga";
			return false;
		}
		$kinerja = DB::table('standart_layanan')
			->leftJoin('kinerja_master', function ($leftJoin) use ($lembaga_id, $tahun) {
				$leftJoin->on('standart_layanan.id', '=', 'kinerja_master.standart_layanan_id')
					->where('kinerja_master.cis_lembaga_id', $lembaga_id)
					->where('kinerja_master.tahun', $tahun);
			})
			->select('standart_layanan.*', 'kinerja_master.sasaran', 'kinerja_master.target', 'kinerja_master.triwulan1', 'kinerja_master.triwulan2', 'kinerja_master.triwulan3', 'kinerja_master.triwulan4', 'kinerja_master.id AS kinerja_id')
			->orderBy('standart_layanan.id')->get();
		$data = array(
			'kinerja' => $kinerja,
			'tahun' => $tahun,
			'lembaga_id' => $lembaga_id,
		);
		return view('kinerja.add_ajax', $data);
	}

	public function getListPerCis($lembaga_id, $tahun) {
		// return 'deye';
		if ($lembaga_id == '') {
			echo "Data Kosong Tidak Ada Lembaga";
			return false;
		}
		$kinerja = DB::table('standart_layanan')
			->leftJoin('kinerja_master', function ($leftJoin) use ($lembaga_id, $tahun) {
				$leftJoin->on('standart_layanan.id', '=', 'kinerja_master.standart_layanan_id')
					->where('kinerja_master.cis_lembaga_id', $lembaga_id)
					->where('kinerja_master.tahun', $tahun);
			})
			->select('standart_layanan.*', 'kinerja_master.sasaran', 'kinerja_master.target', 'kinerja_master.triwulan1', 'kinerja_master.triwulan2', 'kinerja_master.triwulan3', 'kinerja_master.triwulan4', 'kinerja_master.id AS kinerja_id')
			->orderBy('standart_layanan.id')->get();

		$row_percent = array();

		foreach ($kinerja as $key => $value) {
			$a = $value->triwulan1 ? $value->triwulan1 : 0;
			$b = $value->triwulan2 ? $value->triwulan2 : 0;
			$c = $value->triwulan3 ? $value->triwulan3 : 0;
			$d = $value->triwulan4 ? $value->triwulan4 : 0;
			$x = $value->target ? $value->target : 0;

			$total = $a + $b + $c + $d;

			$kinerja[$key]->total = $total;

			$predikat = 'Kurang Baik';

			if ($total != 0 && $x != 0) {
				$percent = ($total / $x) * 100;
				$kinerja[$key]->percent = $percent;
			} else {
				$percent = 0;
				$kinerja[$key]->percent = $percent;
			}

			if ($value->target != '' or $value->target != 0) {
				$row_percent[] = $percent;
			}

			if (count($row_percent) > 0) {
				$rata_percent = array_sum($row_percent) / count($row_percent);
			} else {
				$rata_percent = 0;
			}

			if ($rata_percent > 0 && $rata_percent <= 60) {
				$predikat = 'Kurang Baik';
			} elseif ($rata_percent > 60 && $rata_percent <= 80) {
				$predikat = 'Baik';
			} elseif ($rata_percent > 80 && $rata_percent <= 100) {
				$predikat = 'Sangat Baik';
			}

			// $kinerja[$key]->percent = $total ? ($total / $value->target) * 100 : 0;
		}

		$keterangan_kinerja = KinerjaKeterangan::where('cis_lembaga_id', $lembaga_id)->where('tahun', $tahun)->first();

		// return $kinerja;
		$data = array(
			'kinerja' => $kinerja,
			'tahun' => $tahun,
			'lembaga_id' => $lembaga_id,
			'rata_percent' => $rata_percent,
			'predikat' => $predikat,
			'keterangan_kinerja' => $keterangan_kinerja,
		);
		// return $data;
		return view('kinerja.list_ajax', $data);
	}

	public function getRekapForm() {
		$data = array(
			'title' => 'Rekap Kinerja',
		);
		return view('kinerja.rekap', $data);
	}

	public function getRekap($tahun) {
		$kinerja = DB::table('standart_layanan')
			->leftJoin('kinerja_master', function ($leftJoin) use ($tahun) {
				$leftJoin->on('standart_layanan.id', '=', 'kinerja_master.standart_layanan_id')
					->where('kinerja_master.tahun', $tahun);
			})
			->select('standart_layanan.id', 'standart_layanan.nama', DB::raw('sum(kinerja_master.target) as target'), DB::raw('sum(kinerja_master.triwulan1) as triwulan1'), DB::raw('sum(kinerja_master.triwulan2) as triwulan2'), DB::raw('sum(kinerja_master.triwulan3) as triwulan3'), DB::raw('sum(kinerja_master.triwulan4) as triwulan4'))
			->orderBy('standart_layanan.id')
			->groupBy('standart_layanan.nama', 'standart_layanan.id')->get();

		foreach ($kinerja as $key => $value) {
			$total = $value->triwulan1 + $value->triwulan2 + $value->triwulan3 + $value->triwulan4;
			$kinerja[$key]->total = $total;
			$kinerja[$key]->percent = $total ? ($total / $value->target) * 100 : 0;

		}
		$data = array(
			'kinerja' => $kinerja,
		);
		return view('kinerja.rekap_ajax', $data);
	}
}
