<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SasaranProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class SasaranProgramKoperasiController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$user = Auth::user();

		$tahun = Input::get('tahun');

		$content = SasaranProgram::query();

		$content->with('ukmtable')->where('lembaga_id', $user->adminlembagas->lembaga_id)->where('ukmtable_type', 'koperasi');

		if ($tahun == '') {
			$tahun = date('Y');
		}

		$content->where('tahun', $tahun);

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'tahun' => $tahun,
		);

		// return $data;

		return view('dashboard.admin.sasaran_koperasi.list', $data);
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

	public function laporan() {
		$user = Auth::user();

		$tahun = Input::get('tahun');

		$content = SasaranProgram::query();

		$content->with('ukmtable')->where('lembaga_id', $user->adminlembagas->lembaga_id)->where('ukmtable_type', 'koperasi');

		if ($tahun == '') {
			$tahun = date('Y');
		}

		$content->where('tahun', $tahun);

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'tahun' => $tahun,
		);

		// return $data;

		return view('dashboard.admin.sasaran_koperasi.laporan', $data);
	}

	public function export() {
		$user = Auth::user();

		$tahun = Input::get('tahun');

		$content = SasaranProgram::query();

		$content->with('ukmtable')->where('lembaga_id', $user->adminlembagas->lembaga_id)->where('ukmtable_type', 'koperasi');

		if ($tahun == '') {
			$tahun = date('Y');
		}

		$content->where('tahun', $tahun);

		$data = $content->get();

		if ($data->count() == 0) {
			return redirect('adm/sasaran-koperasi-laporan')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
		}

		return Excel::create('Sasaran Program Koperasi ' . $tahun, function ($excel) use ($data) {
			$excel->sheet('mySheet', function ($sheet) use ($data) {
				$sheet->cell('A1', function ($cell) {$cell->setValue('ID Koperasi');});
				$sheet->cell('B1', function ($cell) {$cell->setValue('Nama Koperasi');});
				$sheet->cell('C1', function ($cell) {$cell->setValue('Alamat');});
				$sheet->cell('D1', function ($cell) {$cell->setValue('Nomor dan Tanggal Badan Hukum');});
				$sheet->cell('E1', function ($cell) {$cell->setValue('Jenis Koperasi');});
				$sheet->cell('F1', function ($cell) {$cell->setValue('Tanggal RAT Tahun Buku');});
				$sheet->cell('G1', function ($cell) {$cell->setValue('Anggota');});
				$sheet->cell('H1', function ($cell) {$cell->setValue('Karyawan');});
				$sheet->cell('I1', function ($cell) {$cell->setValue('Asset');});
				$sheet->cell('J1', function ($cell) {$cell->setValue('Modal Sendiri');});
				$sheet->cell('K1', function ($cell) {$cell->setValue('Modal Luar');});
				$sheet->cell('L1', function ($cell) {$cell->setValue('Volume Usaha');});
				$sheet->cell('M1', function ($cell) {$cell->setValue('Sisa Hasil Usaha');});
				$sheet->cell('N1', function ($cell) {$cell->setValue('Kegiatan Usaha');});
				if (!empty($data)) {
					foreach ($data as $key => $value) {
						$i = $key + 2;
						$sheet->cell('A' . $i, $value->ukmtable->id_koperasi);
						$sheet->cell('B' . $i, $value->ukmtable->nama_koperasi);
						$sheet->cell('C' . $i, $value->ukmtable->alamat);
						$sheet->cell('D' . $i, $value->ukmtable->nomor_badan_hukum . ' / ' . $value->ukmtable->tgl_badan_hukum);
						$sheet->cell('E' . $i, $value->ukmtable->jenis_koperasi);
						$sheet->cell('F' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->tgl_rat_tahun_buku : '');
						$sheet->cell('G' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_anggota : '');
						$sheet->cell('H' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_karyawan : '');
						$sheet->cell('I' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_asset : '');
						$sheet->cell('J' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_modal_sendiri : '');
						$sheet->cell('K' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_modal_luar : '');
						$sheet->cell('L' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->valume_usaha : '');
						$sheet->cell('M' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->sisa_hasil : '');
						$sheet->cell('N' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->kegiatan_usaha : '');
					}
				}
			});
		})->download('xlsx');
	}
}
