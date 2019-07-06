<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KinerjaKeterangan;
use App\KinerjaMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KinerjaKonsultanController extends Controller {

	public function index() {
		$user = Auth::user();

		$kinerjamaster = KinerjaMaster::with('standart_layanan', 'lembaga')->where('cis_lembaga_id', $user->adminlembagas->lembaga_id)->get();

		$data = array(
			'title' => 'Daftar Kinerja',
			'data' => $kinerjamaster,
		);
		return view('dashboard.admin.kinerja.list', $data);
	}

	public function getListKinerja($tahun) {
		$user = Auth::user();
		$lembaga_id = $user->adminlembagas->lembaga_id;

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

			$percent = $total ? ($total / $value->target) * 100 : 0;
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
