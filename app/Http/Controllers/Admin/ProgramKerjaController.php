<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProgramKerja;
use App\SasaranProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class ProgramKerjaController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$user = Auth::user();

		$sasaran_program_id = Input::get('sasaran_program_id');

		$content = ProgramKerja::query();

		$content->with('sasaran_program')->where('lembaga_id', $user->adminlembagas->lembaga_id);

		if (Input::get('sasaran_program_id')) {
			$content->where('sasaran_program_id', $sasaran_program_id);
		}

		$content = $content->paginate();

		$data = array(
			'sasaran_program' => SasaranProgram::with('ukmtable')->where('lembaga_id', $user->adminlembagas->lembaga_id)->where('lock', 'Yes')->get(),
			'data' => $content,
			'sasaran_program_id' => $sasaran_program_id,
		);
		// return $data;
		return view('dashboard.admin.program_kerja.list', $data);
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

		$sasaran_program_id = Input::get('sasaran_program_id');

		$content = ProgramKerja::query();

		$content->with('sasaran_program')->where('lembaga_id', $user->adminlembagas->lembaga_id);

		if (Input::get('sasaran_program_id')) {
			$content->where('sasaran_program_id', $sasaran_program_id);
		}

		$content = $content->paginate();

		$data = array(
			'sasaran_program' => SasaranProgram::with('ukmtable')->where('lembaga_id', $user->adminlembagas->lembaga_id)->where('lock', 'Yes')->get(),
			'data' => $content,
			'sasaran_program_id' => $sasaran_program_id,
		);
		// return $data;
		return view('dashboard.admin.program_kerja.laporan', $data);
	}

	public function export() {
		$user = Auth::user();

		$nama_kumkm = '';

		$sasaran_program_id = Input::get('sasaran_program_id');

		$content = ProgramKerja::query();

		$content->with('sasaran_program')->where('lembaga_id', $user->adminlembagas->lembaga_id);

		if (Input::get('sasaran_program_id')) {
			$content->where('sasaran_program_id', $sasaran_program_id);
			$sasaran_program = SasaranProgram::find($sasaran_program_id);
			$nama_kumkm = $sasaran_program->ukmtable->nama_kumkm;
		}

		$data = $content->get();

		if ($data->count() == 0) {
			return redirect('adm/program-kerja-laporan')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
		}

		return Excel::create('Kartu Program Kerja PLUT KUMKM ' . $nama_kumkm . ' ' . date('d/m/Y'), function ($excel) use ($data) {
			$excel->sheet('mySheet', function ($sheet) use ($data) {
				$sheet->cell('A1', function ($cell) {$cell->setValue('KUMKM');});
				$sheet->cell('B1', function ($cell) {$cell->setValue('Identifikasi Permasalahan');});
				$sheet->cell('C1', function ($cell) {$cell->setValue('Program Kerja Pendampingan');});
				$sheet->cell('D1', function ($cell) {$cell->setValue('Target Capaian');});
				$sheet->cell('E1', function ($cell) {$cell->setValue('Konsultan Pendamping Penanggung Jawab');});

				if (!empty($data)) {
					foreach ($data as $key => $value) {
						$i = $key + 2;
						$sheet->cell('A' . $i, $value->sasaran_program->ukmtable->nama_kumkm);
						$sheet->cell('B' . $i, $value->permasalahan);
						$sheet->cell('C' . $i, $value->proker_pendampingan);
						$sheet->cell('D' . $i, $value->target_capaian);
						$sheet->cell('E' . $i, $value->bidang_layanan->name);
					}
				}
			});
		})->download('xlsx');
	}
}
