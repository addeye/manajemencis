<?php

namespace App\Http\Controllers\Konsultan;

use App\Http\Controllers\Controller;
use App\Konsultan;
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

		$content->with('program_kerja')->where('lembaga_id', $user->konsultans->lembaga_id);

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
		return view('dashboard.konsultan.pelaksanaan_pendampingan.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$user = Auth::user();
		$data = array(
			'program_kerja' => ProgramKerja::where('lembaga_id', $user->konsultans->lembaga_id)->where('lock', 'Yes')->where('tahun', date('Y'))->get(),
		);

		return view('dashboard.konsultan.pelaksanaan_pendampingan.add', $data);
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
		$data->konsultan_id = $user->konsultans->id;
		$data->lembaga_id = $user->konsultans->lembaga_id;
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
			'program_kerja' => ProgramKerja::where('lembaga_id', $user->konsultans->lembaga_id)->where('lock', 'Yes')->where('tahun', date('Y'))->get(),
			'data' => PelaksanaanPendampingan::find($id),
		);

		return view('dashboard.konsultan.pelaksanaan_pendampingan.edit', $data);
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
			return redirect('pelaksanaan-pendampingan/' . $id . '/edit')->withErrors($validator)->withInput();
		}

		$program_kerja = ProgramKerja::find($request->program_kerja_id);
		$nama_kumkm = $program_kerja->sasaran_program->nama_kumkm;

		$data = PelaksanaanPendampingan::find($id);
		$data->program_kerja_id = $request->program_kerja_id;
		$data->tanggal = date('Y-m-d', strtotime($request->tanggal));
		$data->materi = $request->materi;
		$data->tindak_lanjut = $request->tindak_lanjut;
		$data->konsultan_id = $user->konsultans->id;
		$data->lembaga_id = $user->konsultans->lembaga_id;
		$data->nama_kumkm = $nama_kumkm;
		$data->save();

		if ($data) {
			return redirect('pelaksanaan-pendampingan')->with('success', 'Data Pelaksanaan Pendampingan Berhasil Diupdate');
		}
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

	private function base_report_excel($nama_file, $data) {
		return Excel::create($nama_file, function ($excel) use ($data) {
			$excel->sheet('mySheet', function ($sheet) use ($data) {
				$sheet->cell('A1', function ($cell) {$cell->setValue('Konsultan');});
				$sheet->cell('B1', function ($cell) {$cell->setValue('KUMKM');});
				$sheet->cell('C1', function ($cell) {$cell->setValue('Identifikasi Permasalahan');});
				$sheet->cell('D1', function ($cell) {$cell->setValue('Program Kerja Pendampingan');});
				$sheet->cell('E1', function ($cell) {$cell->setValue('Tgl/Bln/Thn');});
				$sheet->cell('F1', function ($cell) {$cell->setValue('Materi Pendampingan');});
				$sheet->cell('G1', function ($cell) {$cell->setValue('Skema Tindakan Lebih Lanjut');});

				if (!empty($data)) {
					foreach ($data as $key => $value) {
						$i = $key + 2;
						$sheet->cell('A' . $i, $value->konsultans->nama_lengkap);
						$sheet->cell('B' . $i, $value->nama_kumkm);
						$sheet->cell('C' . $i, $value->program_kerja->permasalahan);
						$sheet->cell('D' . $i, $value->program_kerja->proker_pendampingan);
						$sheet->cell('E' . $i, date('d/m/Y', strtotime($value->tanggal)));
						$sheet->cell('F' . $i, $value->materi);
						$sheet->cell('G' . $i, $value->tindak_lanjut);
					}
				}
			});
		})->download('xlsx');
	}

	public function laporan() {
		$user = Auth::user();

		$nama_kumkm = Input::get('nama_kumkm');
		$tahun = Input::get('tahun');
		$konsultan_id = Input::get('konsultan_id');

		$content = PelaksanaanPendampingan::query();

		$content->whereHas('konsultans', function ($q) {
			$q->orderBy('nama_lengkap');
		})->orderBy('konsultan_id');

		$content->orderBy('tanggal');

		$content->with('program_kerja')->where('lembaga_id', $user->konsultans->lembaga_id);

		if (Input::get('nama_kumkm')) {
			$content->where('nama_kumkm', 'like', '%' . $nama_kumkm . '%');
		}

		if (Input::get('konsultan_id')) {
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
			'konsultans' => Konsultan::where('lembaga_id', $user->konsultans->lembaga_id)->get(),
			'konsultan_id' => $konsultan_id,
			'tahun' => $tahun,

		);
		// return $data;
		return view('dashboard.konsultan.pelaksanaan_pendampingan.laporan', $data);
	}

	public function export() {
		$user = Auth::user();

		$nama_kumkm = Input::get('nama_kumkm');
		$tahun = Input::get('tahun');

		$content = PelaksanaanPendampingan::query();

		$content->whereHas('konsultans', function ($q) {
			$q->orderBy('nama_lengkap');
		})->orderBy('konsultan_id');

		$content->orderBy('tanggal');

		$content->with('program_kerja')->where('lembaga_id', $user->konsultans->lembaga_id);

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

		$namafileunduh = 'Kartu Pelaksanaan Pendampingan ' . $nama_kumkm . ' ' . date('d/m/Y');

		return $this->base_report_excel($namafileunduh, $data);
	}

	//bulanan

	public function laporanBulanan() {
		$user = Auth::user();

		$bulan = Input::get('bulan');
		$tahun = Input::get('tahun');

		$content = PelaksanaanPendampingan::query();

		$content->whereHas('konsultans', function ($q) {
			$q->orderBy('nama_lengkap');
		})->orderBy('konsultan_id');

		$content->orderBy('tanggal');

		$content->with('program_kerja')->where('lembaga_id', $user->konsultans->lembaga_id);

		if (Input::get('bulan')) {
			$content->whereMonth('tanggal', $bulan);
		}

		if ($tahun == '') {
			$tahun = date('Y');
		}

		$content->whereYear('tanggal', $tahun);

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'bulan' => $bulan,
			'tahun' => $tahun,

		);
		// return $data;
		return view('dashboard.konsultan.pelaksanaan_pendampingan.laporan_bulanan', $data);
	}

	public function laporanBulananExport() {
		$nama_bulan = '';

		$bulanarray = [
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		];

		$user = Auth::user();

		$bulan = Input::get('bulan');
		$tahun = Input::get('tahun');

		$content = PelaksanaanPendampingan::query();

		$content->whereHas('konsultans', function ($q) {
			$q->orderBy('nama_lengkap');
		})->orderBy('konsultan_id');

		$content->orderBy('tanggal');

		$content->with('program_kerja')->where('lembaga_id', $user->konsultans->lembaga_id);

		if (Input::get('bulan')) {
			$content->whereMonth('tanggal', $bulan);
			$nama_bulan = $bulanarray[$bulan];
		}

		if ($tahun == '') {
			$tahun = date('Y');
		}

		$content->whereYear('tanggal', $tahun);

		$data = $content->get();

		if ($data->count() == 0) {
			return redirect('pelaksanaan-pendampingan-laporan-bulanan')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
		}

		$namafileunduh = 'Rekap Laporan Bulanan Pelaksanaan Pendampingan ' . $nama_bulan . ' ' . date('d/m/Y');

		return $this->base_report_excel($namafileunduh, $data);
	}

	public function laporanTriwulan() {
		$user = Auth::user();

		$triwulan = Input::get('triwulan');
		$tahun = Input::get('tahun');

		$content = PelaksanaanPendampingan::query();

		$content->whereHas('konsultans', function ($q) {
			$q->orderBy('nama_lengkap');
		})->orderBy('konsultan_id');

		$content->orderBy('tanggal');

		$content->with('program_kerja')->where('lembaga_id', $user->konsultans->lembaga_id);

		if (Input::get('triwulan')) {
			if ($triwulan == 1) {

				$content->whereMonth('tanggal', '>=', 1)->whereMonth('tanggal', '<=', 3);

			} elseif ($triwulan == 2) {

				$content->whereMonth('tanggal', '>=', 4)->whereMonth('tanggal', '<=', 6);

			} elseif ($triwulan == 3) {

				$content->whereMonth('tanggal', '>=', 7)->whereMonth('tanggal', '<=', 9);

			} elseif ($triwulan == 4) {

				$content->whereMonth('tanggal', '>=', 10)->whereMonth('tanggal', '<=', 12);
			}
		}

		if ($tahun == '') {
			$tahun = date('Y');
		}

		$content->whereYear('tanggal', $tahun);

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'triwulan' => $triwulan,
			'tahun' => $tahun,

		);
		// return $data;
		return view('dashboard.konsultan.pelaksanaan_pendampingan.laporan_triwulan', $data);
	}

	public function laporanTriwulanExport() {
		$user = Auth::user();

		$triwulan = Input::get('triwulan');
		$tahun = Input::get('tahun');

		$nama_triwulan = '';

		$content = PelaksanaanPendampingan::query();

		$content->whereHas('konsultans', function ($q) {
			$q->orderBy('nama_lengkap');
		})->orderBy('konsultan_id');

		$content->orderBy('tanggal');

		$content->with('program_kerja')->where('lembaga_id', $user->konsultans->lembaga_id);

		if (Input::get('triwulan')) {
			if ($triwulan == 1) {

				$content->whereMonth('tanggal', '>=', 1)->whereMonth('tanggal', '<=', 3);
				$nama_triwulan = 'Triwulan 1 (Jan-Mar)';

			} elseif ($triwulan == 2) {

				$content->whereMonth('tanggal', '>=', 4)->whereMonth('tanggal', '<=', 6);
				$nama_triwulan = 'Triwulan 2 (Apr-Jun)';

			} elseif ($triwulan == 3) {

				$content->whereMonth('tanggal', '>=', 7)->whereMonth('tanggal', '<=', 9);
				$nama_triwulan = 'Triwulan 3 (Jul-Sept)';

			} elseif ($triwulan == 4) {

				$content->whereMonth('tanggal', '>=', 10)->whereMonth('tanggal', '<=', 12);
				$nama_triwulan = 'Triwulan 4 (Okt-Des)';
			}
		}

		if ($tahun == '') {
			$tahun = date('Y');
		}

		$content->whereYear('tanggal', $tahun);

		$data = $content->get();

		if ($data->count() == 0) {
			return redirect('pelaksanaan-pendampingan-laporan-triwulan')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
		}

		$namafileunduh = 'Rekap Laporan Triwulan Pelaksanaan Pendampingan ' . $nama_triwulan . ' ' . date('d/m/Y');

		return $this->base_report_excel($namafileunduh, $data);
	}

	public function laporanTahunan() {
		$user = Auth::user();

		$tahun = Input::get('tahun');

		$content = PelaksanaanPendampingan::query();

		$content->whereHas('konsultans', function ($q) {
			$q->orderBy('nama_lengkap');
		})->orderBy('konsultan_id');

		$content->orderBy('tanggal');

		$content->with('program_kerja')->where('lembaga_id', $user->konsultans->lembaga_id);

		if ($tahun == '') {
			$tahun = date('Y');
		}

		$content->whereYear('tanggal', $tahun);

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'tahun' => $tahun,

		);
		// return $data;
		return view('dashboard.konsultan.pelaksanaan_pendampingan.laporan_tahunan', $data);
	}

	public function laporanTahunanExport() {
		$user = Auth::user();

		$tahun = Input::get('tahun');

		$nama_triwulan = '';

		$content = PelaksanaanPendampingan::query();

		$content->whereHas('konsultans', function ($q) {
			$q->orderBy('nama_lengkap');
		})->orderBy('konsultan_id');

		$content->orderBy('tanggal');

		$content->with('program_kerja')->where('lembaga_id', $user->konsultans->lembaga_id);

		if ($tahun == '') {
			$tahun = date('Y');
		}

		$content->whereYear('tanggal', $tahun);

		$data = $content->get();

		if ($data->count() == 0) {
			return redirect('pelaksanaan-pendampingan-laporan-tahunan')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
		}

		$namafileunduh = 'Rekap Laporan Tahunan Pelaksanaan Pendampingan ' . $tahun . ' ' . date('d/m/Y');

		return $this->base_report_excel($namafileunduh, $data);
	}
}
