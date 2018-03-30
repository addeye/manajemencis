<?php

namespace App\Http\Controllers;

use App\Cis_lembaga;
use App\ProgramKerja;
use App\SasaranProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class ProgramKerjaController extends Controller {
	public function getList() {
		$sasaran_program_id = Input::get('sasaran_program_id');
		$lembaga_id = Input::get('lembaga_id');

		$content = ProgramKerja::query();

		$content->with('sasaran_program');

		if ($sasaran_program_id) {
			$content->where('sasaran_program_id', $sasaran_program_id);
		}

		if ($lembaga_id) {
			$content->where('lembaga_id', $lembaga_id);
		}

		$content = $content->paginate();

		$data = array(
			'sasaran_program' => SasaranProgram::with('ukmtable')->where('lembaga_id', $lembaga_id)->get(),
			'data' => $content,
			'sasaran_program_id' => $sasaran_program_id,
			'lembaga' => Cis_lembaga::all(),
			'lembaga_id' => $lembaga_id,
		);
		// return $data;
		return view('program_kerja.list', $data);
	}

	public function lock(Request $request, $id) {
		$statuslock = $request->lock;
		if ($statuslock == 'Yes') {
			$lock = 'No';
		} elseif ($statuslock == 'No') {
			$lock = 'Yes';
		}
		$data = ProgramKerja::find($id);
		$data->lock = $lock;
		$data->save();

		if ($data) {
			return redirect('program-kerja-pendampingan')->with('success', 'Status LOCK menjadi ' . $request->lock);
		}

	}

	public function export() {
		$nama_kumkm = '';

		$sasaran_program_id = Input::get('sasaran_program_id');
		$lembaga_id = Input::get('lembaga_id');

		$content = ProgramKerja::query();

		$content->with('sasaran_program');

		if ($lembaga_id) {
			$content->where('lembaga_id', $lembaga_id);
		}

		if (Input::get('sasaran_program_id')) {
			$content->where('sasaran_program_id', $sasaran_program_id);
			$sasaran_program = SasaranProgram::find($sasaran_program_id);
			$nama_kumkm = $sasaran_program->ukmtable->nama_kumkm;
		}

		$data = $content->get();

		if ($data->count() == 0) {
			return redirect('program-kerja-laporan')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
		}

		return Excel::create('Kartu Program Kerja PLUT KUMKM ' . $nama_kumkm . ' ' . date('d/m/Y'), function ($excel) use ($data) {
			$excel->sheet('mySheet', function ($sheet) use ($data) {
				$sheet->cell('A1', function ($cell) {$cell->setValue('Lembaga');});
				$sheet->cell('B1', function ($cell) {$cell->setValue('KUMKM');});
				$sheet->cell('C1', function ($cell) {$cell->setValue('Identifikasi Permasalahan');});
				$sheet->cell('D1', function ($cell) {$cell->setValue('Program Kerja Pendampingan');});
				$sheet->cell('E1', function ($cell) {$cell->setValue('Target Capaian');});
				$sheet->cell('F1', function ($cell) {$cell->setValue('Konsultan Pendamping Penanggung Jawab');});

				if (!empty($data)) {
					foreach ($data as $key => $value) {
						$i = $key + 2;
						$sheet->cell('A' . $i, $value->sasaran_program->ukmtable->lembaga->plut_name);
						$sheet->cell('B' . $i, $value->sasaran_program->ukmtable->nama_kumkm);
						$sheet->cell('C' . $i, $value->permasalahan);
						$sheet->cell('D' . $i, $value->proker_pendampingan);
						$sheet->cell('E' . $i, $value->target_capaian);
						$sheet->cell('F' . $i, $value->bidang_layanan->name);
					}
				}
			});
		})->download('xlsx');
	}
}
