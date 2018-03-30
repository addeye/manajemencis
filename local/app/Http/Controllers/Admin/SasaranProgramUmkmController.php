<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SasaranProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class SasaranProgramUmkmController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$user = Auth::user();

		$tahun = Input::get('tahun');

		$content = SasaranProgram::query();

		$content->with('ukmtable')->where('lembaga_id', $user->adminlembagas->lembaga_id)->where('ukmtable_type', 'kumkm');

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

		return view('dashboard.admin.sasaran_kumkm.list', $data);
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

		$content->with('ukmtable')->where('lembaga_id', $user->adminlembagas->lembaga_id)->where('ukmtable_type', 'kumkm');

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

		return view('dashboard.admin.sasaran_kumkm.laporan', $data);
	}

	public function export() {
		$user = Auth::user();

		$tahun = Input::get('tahun');

		$content = SasaranProgram::query();

		$content->where('lembaga_id', $user->adminlembagas->lembaga_id)->where('ukmtable_type', 'kumkm');

		if ($tahun == '') {
			$tahun = date('Y');
		}

		$content->where('tahun', $tahun);

		$data = $content->get();

		if ($data->count() == 0) {
			return redirect('adm/sasaran-kumkm-laporan')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
		}

		return Excel::create('Sasaran Program UMKM ' . $tahun, function ($excel) use ($data) {
			$excel->sheet('mySheet', function ($sheet) use ($data) {
				$sheet->cell('A1', function ($cell) {$cell->setValue('ID UMKM');});
				$sheet->cell('B1', function ($cell) {$cell->setValue('Nama UMKM');});
				$sheet->cell('C1', function ($cell) {$cell->setValue('Alamat');});
				$sheet->cell('D1', function ($cell) {$cell->setValue('Tahun Mulai Usaha');});
				$sheet->cell('E1', function ($cell) {$cell->setValue('Jenis Usaha');});
				$sheet->cell('F1', function ($cell) {$cell->setValue('Legalitas');});
				$sheet->cell('G1', function ($cell) {$cell->setValue('Tenaga Kerja (Orang)');});
				$sheet->cell('H1', function ($cell) {$cell->setValue('Modal Sendiri');});
				$sheet->cell('I1', function ($cell) {$cell->setValue('Modal Luar');});
				$sheet->cell('J1', function ($cell) {$cell->setValue('Asset');});
				$sheet->cell('K1', function ($cell) {$cell->setValue('Omset');});
				$sheet->cell('L1', function ($cell) {$cell->setValue('Kegiatan Usaha');});

				if (!empty($data)) {
					foreach ($data as $key => $value) {
						$i = $key + 2;
						$sheet->cell('A' . $i, $value->ukmtable->id_kumkm);
						$sheet->cell('B' . $i, $value->ukmtable->nama_usaha);
						$sheet->cell('C' . $i, $value->ukmtable->alamat);
						$sheet->cell('D' . $i, $value->ukmtable->tgl_mulai_usaha);
						$sheet->cell('E' . $i, $value->ukmtable->bidangusaha ? $value->ukmtable->bidangusaha->name : '');
						$sheet->cell('F' . $i, $value->ukmtable->badan_usaha);
						$sheet->cell('G' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->jml_tenaga_kerja : '');
						$sheet->cell('H' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->modal_sendiri : '');
						$sheet->cell('I' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->modal_hutang : '');
						$sheet->cell('J' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->asset : '');
						$sheet->cell('K' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->omset : '');
						$sheet->cell('L' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->kegiatan_usaha : '');
					}
				}
			});
		})->download('xlsx');
	}
}
