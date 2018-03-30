<?php

namespace App\Http\Controllers\Konsultan;

use App\Bidang_layanan;
use App\Http\Controllers\Controller;
use App\ProgramKerja;
use App\SasaranProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
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

		$content->with('sasaran_program')->where('lembaga_id', $user->konsultans->lembaga_id);

		if (Input::get('sasaran_program_id')) {
			$content->where('sasaran_program_id', $sasaran_program_id);
		}

		$content = $content->paginate();

		$data = array(
			'sasaran_program' => SasaranProgram::with('ukmtable')->where('lembaga_id', $user->konsultans->lembaga_id)->where('lock', 'Yes')->get(),
			'data' => $content,
			'sasaran_program_id' => $sasaran_program_id,
		);
		// return $data;
		return view('dashboard.konsultan.program_kerja.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$user = Auth::user();
		$data = array(
			'sasaran_program' => SasaranProgram::with('ukmtable')->where('lembaga_id', $user->konsultans->lembaga_id)->where('lock', 'Yes')->get(),
			'bidang_layanan' => Bidang_layanan::all(),
		);

		return view('dashboard.konsultan.program_kerja.add', $data);
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
			'sasaran_program_id' => 'required',
			'bidang_layanan_id' => 'required',
			'permasalahan' => 'required',
			'proker_pendampingan' => 'required|max:255',
			'target_capaian' => 'required|max:255',
		];

		$messages = [
			'sasaran_program_id.required' => 'KUMKM harus dipilih',
			'bidang_layanan_id.required' => 'Bidang harus dipilih',
			'permasalahan.required' => 'Identifikasi permasalahan harus terisi',
			'proker_pendampingan.required' => 'Program Kerja Pendampingan harus terisi',
			'proker_pendampingan.max' => 'Program Kerja Pendampingan Max 255 ',
			'target_capaian.required' => 'Target capaian harus terisi',
			'target_capaian.max' => 'Target Capaian Max 255 karakter',
		];
		$validator = Validator::make($data, $rules, $messages);
		if ($validator->fails()) {
			return redirect('program-kerja/create')->withErrors($validator)->withInput();
		}

		$program_kerja = new ProgramKerja();
		$program_kerja->sasaran_program_id = $request->sasaran_program_id;
		$program_kerja->bidang_layanan_id = $request->bidang_layanan_id;
		$program_kerja->permasalahan = $request->permasalahan;
		$program_kerja->proker_pendampingan = $request->proker_pendampingan;
		$program_kerja->tahun = date('Y');
		$program_kerja->target_capaian = $request->target_capaian;
		$program_kerja->nama_konsultan = $user->nama_konsultan;
		$program_kerja->lembaga_id = $user->konsultans->lembaga_id;
		$program_kerja->nama_konsultan = $user->name;
		$program_kerja->save();

		if ($program_kerja) {
			return redirect('program-kerja')->with('success', 'Berhasil Membuat Program Kerja Pendampingan');
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
		$user = Auth::user();
		$data = array(
			'sasaran_program' => SasaranProgram::with('ukmtable')->where('lembaga_id', $user->konsultans->lembaga_id)->where('lock', 'Yes')->get(),
			'bidang_layanan' => Bidang_layanan::all(),
			'data' => ProgramKerja::find($id),
		);

		return view('dashboard.konsultan.program_kerja.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$user = Auth::user();
		$data = $request->all();
		$proker = ProgramKerja::find($id);

		$rules = [
			'sasaran_program_id' => 'required',
			'bidang_layanan_id' => 'required',
			'permasalahan' => 'required',
			'proker_pendampingan' => 'required|max:255',
			'target_capaian' => 'required|max:255',
		];

		$messages = [
			'sasaran_program_id.required' => 'KUMKM harus dipilih',
			'bidang_layanan_id.required' => 'Bidang harus dipilih',
			'permasalahan.required' => 'Identifikasi permasalahan harus terisi',
			'proker_pendampingan.required' => 'Program Kerja Pendampingan harus terisi',
			'proker_pendampingan.max' => 'Program Kerja Pendampingan Max 255 ',
			'target_capaian.required' => 'Target capaian harus terisi',
			'target_capaian.max' => 'Target Capaian Max 255 karakter',
		];
		$validator = Validator::make($data, $rules, $messages);
		if ($validator->fails()) {
			return redirect('program-kerja/' . $proker->id . '/edit')->withErrors($validator)->withInput();
		}

		$program_kerja = ProgramKerja::find($id);
		$program_kerja->sasaran_program_id = $request->sasaran_program_id;
		$program_kerja->bidang_layanan_id = $request->bidang_layanan_id;
		$program_kerja->permasalahan = $request->permasalahan;
		$program_kerja->proker_pendampingan = $request->proker_pendampingan;
		$program_kerja->tahun = date('Y');
		$program_kerja->target_capaian = $request->target_capaian;
		$program_kerja->nama_konsultan = $user->nama_konsultan;
		$program_kerja->lembaga_id = $user->konsultans->lembaga_id;
		$program_kerja->nama_konsultan = $user->name;
		$program_kerja->save();

		if ($program_kerja) {
			return redirect('program-kerja')->with('success', 'Berhasil Edit Program Kerja Pendampingan');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$program_kerja = ProgramKerja::find($id);
		$program_kerja->delete();

		if ($program_kerja) {
			return redirect('program-kerja')->with('success', 'Program Kerja Di Hapus');
		}
	}

	public function lock($id) {
		$program_kerja = ProgramKerja::find($id);
		$program_kerja->lock = 'Yes';
		$program_kerja->save();

		if ($program_kerja) {
			return redirect('program-kerja')->with('success', 'Program Kerja Di Lock');
		}
	}

	public function laporan() {
		$user = Auth::user();

		$sasaran_program_id = Input::get('sasaran_program_id');

		$content = ProgramKerja::query();

		$content->with('sasaran_program')->where('lembaga_id', $user->konsultans->lembaga_id);

		if (Input::get('sasaran_program_id')) {
			$content->where('sasaran_program_id', $sasaran_program_id);
		}

		$content = $content->paginate();

		$data = array(
			'sasaran_program' => SasaranProgram::with('ukmtable')->where('lembaga_id', $user->konsultans->lembaga_id)->where('lock', 'Yes')->get(),
			'data' => $content,
			'sasaran_program_id' => $sasaran_program_id,
		);
		// return $data;
		return view('dashboard.konsultan.program_kerja.laporan', $data);
	}

	public function export() {
		$user = Auth::user();

		$nama_kumkm = '';

		$sasaran_program_id = Input::get('sasaran_program_id');

		$content = ProgramKerja::query();

		$content->with('sasaran_program')->where('lembaga_id', $user->konsultans->lembaga_id);

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
