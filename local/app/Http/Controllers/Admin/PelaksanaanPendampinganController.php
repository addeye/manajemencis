<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PelaksanaanPendampingan;
use App\ProgramKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class PelaksanaanPendampinganController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$user = Auth::user();

		$nama_kumkm = Input::get('nama_kumkm');
		$tahun = Input::get('tahun');

		$content = PelaksanaanPendampingan::query();

		$content->with('program_kerja')->where('lembaga_id', $user->adminlembagas->lembaga_id);

		if (Input::get('nama_kumkm')) {
			$content->where('nama_kumkm', 'like', '%' . $nama_kumkm . '%');
		}

		if ($tahun == '') {
			$tahun = date('Y');
		}

		$content->whereYear('tanggal', $tahun);

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'nama_kumkm' => $nama_kumkm,
			'tahun' => $tahun,

		);
		// return $data;
		return view('dashboard.admin.pelaksanaan_pendampingan.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$user = Auth::user();
		$data = array(
			'program_kerja' => ProgramKerja::where('lembaga_id', $user->adminlembagas->lembaga_id)->where('lock', 'Yes')->where('tahun', date('Y'))->get(),
		);

		return view('dashboard.admin.pelaksanaan_pendampingan.add', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$user = Auth::user();
		$rules = [
			'program_kerja_id' => 'required',
			'tanggal' => 'required|date_format:d-m-Y',
			'materi' => 'required|max:255',
			'tindak_lanjut' => 'required',
		];

		$messages = [
			'program_kerja_id.required' => 'Program Kerja Harus Di Pilih',
			'tanggal.required' => 'Tanggal Pelaksanaan Pendampingan harus terisi',
			'tanggal.date_format' => 'Tanggal Pelaksanaan Pendampingan Format tgl-bln-tahun',
			'materi.required' => 'Materi Pendampingan harus terisi',
			'materi.max' => 'Materi maximal 255 Karakter',
			'tindak_lanjut.required' => 'Skema tindakan lebih lanjut harus terisi',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return redirect('pelaksanaan-pendampingan/create')->withErrors($validator)->withInput();
		}

		$program_kerja = ProgramKerja::find($request->program_kerja_id);
		$nama_kumkm = $program_kerja->sasaran_program->nama_kumkm;

		$data = new PelaksanaanPendampingan();
		$data->program_kerja_id = $request->program_kerja_id;
		$data->tanggal = date('Y-m-d', strtotime($request->tanggal));
		$data->materi = $request->materi;
		$data->tindak_lanjut = $request->tindak_lanjut;
		$data->konsultan_id = $user->adminlembagas->id;
		$data->lembaga_id = $user->adminlembagas->lembaga_id;
		$data->nama_kumkm = $nama_kumkm;
		$data->save();

		if ($data) {
			return redirect('pelaksanaan-pendampingan')->with('success', 'Data Pelaksanaan Pendampingan Berhasil Dibuat');
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
			'program_kerja' => ProgramKerja::where('lembaga_id', $user->adminlembagas->lembaga_id)->where('lock', 'Yes')->where('tahun', date('Y'))->get(),
			'data' => PelaksanaanPendampingan::find($id),
		);

		return view('dashboard.admin.pelaksanaan_pendampingan.edit', $data);
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
		$pelaksanaan = PelaksanaanPendampingan::find($id);
		$pelaksanaan->delete();

		if ($pelaksanaan) {
			return redirect('pelaksanaan-pendampingan')->with('success', 'Data Pelaksanaan Pendampingan Di Hapus');
		}
	}

	public function lock($id) {
		$pelaksanaan = PelaksanaanPendampingan::find($id);
		$pelaksanaan->lock = 'Yes';
		$pelaksanaan->save();

		if ($pelaksanaan) {
			return redirect('pelaksanaan-pendampingan')->with('success', 'Data Pelaksanaan Berhasil Di LOCK');
		}
	}

	public function laporan() {
		$user = Auth::user();

		$nama_kumkm = Input::get('nama_kumkm');
		$tahun = Input::get('tahun');

		$content = PelaksanaanPendampingan::query();

		$content->with('program_kerja')->where('lembaga_id', $user->adminlembagas->lembaga_id);

		if (Input::get('nama_kumkm')) {
			$content->where('nama_kumkm', 'like', '%' . $nama_kumkm . '%');
		}

		if ($tahun == '') {
			$tahun = date('Y');
		}

		$content->whereYear('tanggal', $tahun);

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'nama_kumkm' => $nama_kumkm,
			'tahun' => $tahun,

		);
		// return $data;
		return view('dashboard.admin.pelaksanaan_pendampingan.laporan', $data);
	}

	public function export() {
		$user = Auth::user();

		$nama_kumkm = Input::get('nama_kumkm');
		$tahun = Input::get('tahun');

		$content = PelaksanaanPendampingan::query();

		$content->with('program_kerja')->where('lembaga_id', $user->adminlembagas->lembaga_id);

		if (Input::get('nama_kumkm')) {
			$content->where('nama_kumkm', 'like', '%' . $nama_kumkm . '%');
		}

		if ($tahun == '') {
			$tahun = date('Y');
		}

		$content->whereYear('tanggal', $tahun);

		$data = $content->get();

		if ($data->count() == 0) {
			return redirect('pelaksanaan-pendampingan-laporan')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
		}

		return Excel::create('Kartu Pelaksanaan Pendampingan ' . $nama_kumkm . ' ' . date('d/m/Y'), function ($excel) use ($data) {
			$excel->sheet('mySheet', function ($sheet) use ($data) {
				$sheet->cell('A1', function ($cell) {$cell->setValue('KUMKM');});
				$sheet->cell('B1', function ($cell) {$cell->setValue('Identifikasi Permasalahan');});
				$sheet->cell('C1', function ($cell) {$cell->setValue('Program Kerja Pendampingan');});
				$sheet->cell('D1', function ($cell) {$cell->setValue('Tgl/Bln/Thn');});
				$sheet->cell('E1', function ($cell) {$cell->setValue('Materi Pendampingan');});
				$sheet->cell('F1', function ($cell) {$cell->setValue('Skema Tindakan Lebih Lanjut');});

				if (!empty($data)) {
					foreach ($data as $key => $value) {
						$i = $key + 2;
						$sheet->cell('A' . $i, $value->nama_kumkm);
						$sheet->cell('B' . $i, $value->program_kerja->permasalahan);
						$sheet->cell('C' . $i, $value->program_kerja->proker_pendampingan);
						$sheet->cell('D' . $i, date('d/m/Y', strtotime($value->tanggal)));
						$sheet->cell('E' . $i, $value->materi);
						$sheet->cell('F' . $i, $value->tindak_lanjut);
					}
				}
			});
		})->download('xlsx');
	}
}
