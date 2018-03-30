<?php

namespace App\Http\Controllers\Konsultan;

use App\Http\Controllers\Controller;
use App\Koperasi;
use App\KoperasiDetail;
use App\Repositories\RegenciesRepository;
use App\SasaranProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class KoperasiController extends Controller {

	protected $regencies;

	public function __construct(RegenciesRepository $regenciesRepository) {
		$this->regencies = $regenciesRepository;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$user = Auth::user();

		$byname = Input::get('byname');

		$content = Koperasi::query();

		$content->where('lembaga_id', $user->konsultans->lembaga_id);

		$content->with(['koperasi_detail' => function ($q) {
			$q->orderBy('created_at', 'desc');
		}]);

		if (Input::get('byname')) {
			// $content->whereHas('koperasi_detail', function ($q) use ($tahun) {
			// 	$q->whereYear('tanggal_keadaan', $tahun);
			// });

			// $content->with(['koperasi_detail' => function ($q) use ($tahun) {
			// 	$q->whereYear('tanggal_keadaan', $tahun);
			// }]);

			$content->where('nama_koperasi', 'like', '%' . $byname . '%');
		}

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'byname' => $byname,
		);
		// return $data;
		return view('dashboard.konsultan.koperasi.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$data = array(
			'regencies' => $this->regencies->getAll(),
		);
		return view('dashboard.konsultan.koperasi.add', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$user = Auth::user();
		$lembaga_id = $user->konsultans->lembaga_id;
		$rules = [
			'nama_koperasi' => 'required',
			'regency_id' => 'required',
			'alamat' => 'required',
			'nomor_badan_hukum' => 'required',
			'tgl_badan_hukum' => 'required|date_format:d-m-Y',
			'jenis_koperasi' => 'required',
			'tgl_rat_tahun_buku' => 'required|date_format:d-m-Y',
			'jml_anggota' => 'required|numeric',
			'jml_karyawan' => 'required|numeric',
			'jml_asset' => 'required|numeric',
			'jml_modal_sendiri' => 'required|numeric',
			'jml_modal_luar' => 'required|numeric',
			'volume_usaha' => 'required|numeric',
			'sisa_hasil' => 'required|numeric',
			'kegiatan_usaha' => 'required|max:255',
			'tanggal_keadaan' => 'required|date_format:d-m-Y',
		];

		$messages = [
			'nama_koperasi.required' => 'Nama koperasi harus terisi',
			'regency_id.required' => 'Kabupaten Kota Harus Terisi',
			'alamat.required' => 'Alamat harus terisi',
			'nomor_badan_hukum.required' => 'Nomor badan hukum harus terisi',
			'tgl_badan_hukum.required' => 'Tanggal badan hukum harus terisi',
			'tgl_badan_hukum.date_format' => 'Tanggal badan hukum harus berupa tanggal',
			'jenis_koperasi.required' => 'Jenis Koperasi harus terisi',
			'tgl_rat_tahun_buku.required' => 'Tanggal RAT tahun buku harus terisi',
			'tgl_rat_tahun_buku.date_format' => 'Tanggal RAT tahun buku harus berupa tanggal',

			'jml_anggota.required' => 'Jumlah anggota harus terisi',
			'jml_anggota.numeric' => 'Jumlah anggota harus angka',

			'jml_karyawan.required' => 'Jumlah Karyawan harus terisi',
			'jml_karyawan.numeric' => 'Jumlah Karyawan harus angka',

			'jml_asset.required' => 'Jumlah asset harus terisi',
			'jml_asset.numeric' => 'Jumlah asset harus angka',

			'jml_modal_sendiri.required' => 'Jumlah Modal Sendiri harus terisi',
			'jml_modal_sendiri.numeric' => 'Jumlah Modal Sendiri harus angka',

			'jml_modal_luar.required' => 'Jumlah Modal Luar harus terisi',
			'jml_modal_luar.numeric' => 'Jumlah Modal Luar harus angka',

			'volume_usaha.required' => 'Omset harus terisi',
			'volume_usaha.numeric' => 'Omset harus angka',

			'sisa_hasil.required' => 'Sisa Hasil harus terisi',
			'sisa_hasil.numeric' => 'Sisa Hasil harus angka',

			'kegiatan_usaha.required' => 'Kegiatan Usaha harus terisi',
			'kegiatan_usaha.max' => 'Kegiatan Usaha maximal 255 Karakter',
			'tanggal_keadaan.required' => 'Tanggal Keadaan harus terisi',
			'tanggal_keadaan.date_format' => 'Tanggal Keadaan Format DD-MM-TTTT',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return redirect('koperasi/create')->withErrors($validator)->withInput();
		}

		$id_koperasi = $request->regency_id . rand(11111111, 99999999);

		$koperasi = new Koperasi();
		$koperasi->id_koperasi = $id_koperasi;
		$koperasi->nama_koperasi = $request->nama_koperasi;
		$koperasi->alamat = $request->alamat;
		$koperasi->nomor_badan_hukum = $request->nomor_badan_hukum;
		$koperasi->tgl_badan_hukum = date('Y-m-d', strtotime($request->tgl_badan_hukum));
		$koperasi->jenis_koperasi = $request->jenis_koperasi;
		$koperasi->lembaga_id = $lembaga_id;
		$koperasi->konsultan = $user->name;
		$koperasi->save();

		if ($koperasi) {
			$detail = new KoperasiDetail();
			$detail->koperasi_id = $koperasi->id;
			$detail->tgl_rat_tahun_buku = date('Y-m-d', strtotime($request->tgl_rat_tahun_buku));
			$detail->jml_anggota = $request->jml_anggota;
			$detail->jml_karyawan = $request->jml_karyawan;
			$detail->jml_asset = $request->jml_asset;
			$detail->jml_modal_sendiri = $request->jml_modal_sendiri;
			$detail->jml_modal_luar = $request->jml_modal_luar;
			$detail->volume_usaha = $request->volume_usaha;
			$detail->sisa_hasil = $request->sisa_hasil;
			$detail->kegiatan_usaha = $request->kegiatan_usaha;
			$detail->tanggal_keadaan = date('Y-m-d', strtotime($request->tanggal_keadaan));
			$detail->save();
		}

		if ($detail) {
			return redirect('koperasi')->with('success', 'Data Koperasi Berhasil disimpan');
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$user = Auth::user();
		$lembaga_id = $user->konsultans->lembaga_id;

		$data = array(
			'data' => Koperasi::where('lembaga_id', $lembaga_id)->where('id', $id)->first(),
		);
		return view('dashboard.konsultan.koperasi.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$data = array(
			'data' => Koperasi::find($id),
		);
		return view('dashboard.konsultan.koperasi.edit', $data);
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
			'nama_koperasi' => 'required',
			'alamat' => 'required',
			'nomor_badan_hukum' => 'required',
			'tgl_badan_hukum' => 'required|date_format:d-m-Y',
			'jenis_koperasi' => 'required',
		];

		$messages = [
			'nama_koperasi.required' => 'Nama koperasi harus terisi',
			'alamat.required' => 'Alamat harus terisi',
			'nomor_badan_hukum.required' => 'Nomor badan hukum harus terisi',
			'tgl_badan_hukum.required' => 'Tanggal badan hukum harus terisi',
			'tgl_badan_hukum.date_format' => 'Tanggal badan hukum harus tanggal',
			'jenis_koperasi.required' => 'Jenis Koperasi harus terisi',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return redirect('koperasi')->withErrors($validator)->withInput();
		}

		$koperasi = Koperasi::find($id);
		$koperasi->nama_koperasi = $request->nama_koperasi;
		$koperasi->alamat = $request->alamat;
		$koperasi->nomor_badan_hukum = $request->nomor_badan_hukum;
		$koperasi->tgl_badan_hukum = date('Y-m-d', strtotime($request->tgl_badan_hukum));
		$koperasi->jenis_koperasi = $request->jenis_koperasi;
		$koperasi->save();

		if ($koperasi) {
			return redirect('koperasi/' . $id)->with('success', 'Data Koperasi Berhasil disimpan');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$data = Koperasi::find($id);

		$sasaran_count = SasaranProgram::where('ukmtable_id', $id)->where('ukmtable_type', 'koperasi')->count();
		if ($sasaran_count != 0) {
			return redirect('koperasi/' . $id)->with('error', 'Data Koperasi Sudah Terdaftar Sebagai Sasaran Program. Hapus Dari Sasaran Program Dahulu. Hubungi Super Admin');
		}

		$data->delete();

		if ($data) {
			return redirect('koperasi')->with('success', 'Data Koperasi Berhasil dihapus');
		}
	}

	public function addDetail($koperasi_id) {
		$user = Auth::user();
		$lembaga_id = $user->konsultans->lembaga_id;

		$kop = Koperasi::where('lembaga_id', $lembaga_id)->where('id', $koperasi_id)->count();

		if (!$kop > 0) {
			return redirect('koperasi')->with('success', 'Maaf tidak bisa hubungi Administrator');
		}

		$data = array(
			'data' => Koperasi::find($koperasi_id),
		);

		return view('dashboard.konsultan.koperasi.add_detail', $data);
	}

	public function editDetail($koperasi_id, $id) {
		$data = array(
			'data' => KoperasiDetail::where('koperasi_id', $koperasi_id)->where('id', $id)->first(),
		);
		return view('dashboard.konsultan.koperasi.edit_detail', $data);
	}

	public function doAddDetail(Request $request) {
		$user = Auth::user();
		$rules = [
			'tgl_rat_tahun_buku' => 'required|date_format:d-m-Y',
			'jml_anggota' => 'required|numeric',
			'jml_karyawan' => 'required|numeric',
			'jml_asset' => 'required|numeric',
			'jml_modal_sendiri' => 'required|numeric',
			'jml_modal_luar' => 'required|numeric',
			'volume_usaha' => 'required|numeric',
			'sisa_hasil' => 'required|numeric',
			'kegiatan_usaha' => 'required',
			'tanggal_keadaan' => 'required|date_format:d-m-Y',
		];

		$messages = [
			'tgl_rat_tahun_buku.required' => 'Tanggal RAT tahun buku harus terisi',
			'tgl_rat_tahun_buku.date_format' => 'Tanggal RAT tahun buku Format DD-MM-TTTT',

			'jml_anggota.required' => 'Jumlah anggota harus terisi',
			'jml_anggota.numeric' => 'Jumlah anggota harus angka',

			'jml_karyawan.required' => 'Jumlah Karyawan harus terisi',
			'jml_karyawan.numeric' => 'Jumlah Karyawan harus angka',

			'jml_asset.required' => 'Jumlah asset harus terisi',
			'jml_asset.numeric' => 'Jumlah asset harus angka',

			'jml_modal_sendiri.required' => 'Jumlah Modal Sendiri harus terisi',
			'jml_modal_sendiri.numeric' => 'Jumlah Modal Sendiri harus angka',

			'jml_modal_luar.required' => 'Jumlah Modal Luar harus terisi',
			'jml_modal_luar.numeric' => 'Jumlah Modal Luar harus angka',

			'volume_usaha.required' => 'Volume Usaha harus terisi',
			'volume_usaha.numeric' => 'Volume Usaha harus angka',

			'sisa_hasil.required' => 'Sisa Hasil harus terisi',
			'sisa_hasil.numeric' => 'Sisa Hasil harus angka',

			'kegiatan_usaha.required' => 'Kegiatan Usaha harus terisi',
			'tanggal_keadaan.required' => 'Tanggal Keadaan harus terisi',
			'tanggal_keadaan.date_format' => 'Tanggal Keadaan Format DD-MM-TTTT',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return redirect('koperasi-detail-add/' . $request->koperasi_id)->withErrors($validator)->withInput();
		}

		$tahun_detail = date('Y', strtotime($request->tanggal_keadaan));

		$datakoperasi = KoperasiDetail::where('koperasi_id', $request->koperasi_id)->whereYear('tanggal_keadaan', $tahun_detail)->count();

		if ($datakoperasi > 0) {
			return redirect('koperasi-detail-add/' . $request->koperasi_id)->with('error', 'Data tahun ' . $tahun_detail . ' sudah ada, silahkan diupdate data yang sudah ada !! ')->withInput();
		}

		$detail = new KoperasiDetail();
		$detail->koperasi_id = $request->koperasi_id;
		$detail->tgl_rat_tahun_buku = date('Y-m-d', strtotime($request->tgl_rat_tahun_buku));
		$detail->jml_anggota = $request->jml_anggota;
		$detail->jml_karyawan = $request->jml_karyawan;
		$detail->jml_asset = $request->jml_asset;
		$detail->jml_modal_sendiri = $request->jml_modal_sendiri;
		$detail->jml_modal_luar = $request->jml_modal_luar;
		$detail->volume_usaha = $request->volume_usaha;
		$detail->sisa_hasil = $request->sisa_hasil;
		$detail->kegiatan_usaha = $request->kegiatan_usaha;
		$detail->tanggal_keadaan = date('Y-m-d', strtotime($request->tanggal_keadaan));
		$detail->save();

		if ($detail) {
			return redirect('koperasi/' . $request->koperasi_id)->with('success', 'Detail Koperasi Berhasil di tambahkan');
		}
	}

	public function doEditDetail(Request $request, $koperasi_id, $id) {
		$user = Auth::user();
		$rules = [
			'tgl_rat_tahun_buku' => 'required|date_format:d-m-Y',
			'jml_anggota' => 'required|numeric',
			'jml_karyawan' => 'required|numeric',
			'jml_asset' => 'required|numeric',
			'jml_modal_sendiri' => 'required|numeric',
			'jml_modal_luar' => 'required|numeric',
			'volume_usaha' => 'required|numeric',
			'sisa_hasil' => 'required|numeric',
			'kegiatan_usaha' => 'required',
			'tanggal_keadaan' => 'required|date_format:d-m-Y',
		];

		$messages = [
			'tgl_rat_tahun_buku.required' => 'Tanggal RAT tahun buku harus terisi',
			'tgl_rat_tahun_buku.date_format' => 'Tanggal RAT tahun buku format DD-MM-TTTT',

			'jml_anggota.required' => 'Jumlah anggota harus terisi',
			'jml_anggota.numeric' => 'Jumlah anggota harus angka',

			'jml_karyawan.required' => 'Jumlah Karyawan harus terisi',
			'jml_karyawan.numeric' => 'Jumlah Karyawan harus angka',

			'jml_asset.required' => 'Jumlah asset harus terisi',
			'jml_asset.numeric' => 'Jumlah asset harus angka',

			'jml_modal_sendiri.required' => 'Jumlah Modal Sendiri harus terisi',
			'jml_modal_sendiri.numeric' => 'Jumlah Modal Sendiri harus angka',

			'jml_modal_luar.required' => 'Jumlah Modal Luar harus terisi',
			'jml_modal_luar.numeric' => 'Jumlah Modal Luar harus angka',

			'volume_usaha.required' => 'Volume Usaha harus terisi',
			'volume_usaha.numeric' => 'Volume Usaha harus angka',

			'sisa_hasil.required' => 'Sisa Hasil harus terisi',
			'sisa_hasil.numeric' => 'Sisa Hasil harus angka',

			'kegiatan_usaha.required' => 'Kegiatan Usaha harus terisi',
			'tanggal_keadaan.required' => 'Tanggal Keadaan harus terisi',
			'tanggal_keadaan.date_format' => 'Tanggal Keadaan Format DD-MM-TTTT',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return redirect('koperasi-detail-edit/' . $koperasi_id . '/' . $id)->withErrors($validator)->withInput();
		}

		$tahun_detail = date('Y', strtotime($request->tanggal_keadaan));

		$datakoperasi = KoperasiDetail::where('koperasi_id', $koperasi_id)->whereYear('tanggal_keadaan', $tahun_detail)->whereNotIn('id', [$id])->count();

		if ($datakoperasi > 0) {
			return redirect('koperasi-detail-edit/' . $koperasi_id . '/' . $id)->with('error', 'Data tahun ' . $tahun_detail . ' sudah ada, silahkan diupdate !! ')->withInput();
		}

		$detail = KoperasiDetail::find($id);
		$detail->tgl_rat_tahun_buku = date('Y-m-d', strtotime($request->tgl_rat_tahun_buku));
		$detail->jml_anggota = $request->jml_anggota;
		$detail->jml_karyawan = $request->jml_karyawan;
		$detail->jml_asset = $request->jml_asset;
		$detail->jml_modal_sendiri = $request->jml_modal_sendiri;
		$detail->jml_modal_luar = $request->jml_modal_luar;
		$detail->volume_usaha = $request->volume_usaha;
		$detail->sisa_hasil = $request->sisa_hasil;
		$detail->kegiatan_usaha = $request->kegiatan_usaha;
		$detail->tanggal_keadaan = date('Y-m-d', strtotime($request->tanggal_keadaan));
		$detail->save();

		if ($detail) {
			return redirect('koperasi/' . $koperasi_id)->with('success', 'Detail Koperasi Berhasil di update');
		}
	}

	public function delDetail($id) {
		$data = KoperasiDetail::find($id);
		$koperasi_id = $data->koperasi_id;

		$koperasi_detail_count = KoperasiDetail::where('koperasi_id', $koperasi_id)->count();

		$sasaran_count = SasaranProgram::where('ukmtable_id', $koperasi_id)->where('ukmtable_type', 'koperasi')->count();

		if ($sasaran_count != 0 AND $koperasi_detail_count == 1) {
			return redirect('koperasi/' . $koperasi_id)->with('error', 'Data Koperasi Sudah Terdaftar Sebagai Sasaran Program. Hapus Dari Sasaran Program Dahulu atau Hubungi Super Admin');
		}

		$data->delete();
		if ($data) {
			return redirect('koperasi/' . $koperasi_id)->with('success', 'Detail Koperasi Berhasil dihapus');
		}
	}

	public function report() {
		$user = Auth::user();

		$byname = Input::get('byname');

		$content = Koperasi::query();

		$content->where('lembaga_id', $user->konsultans->lembaga_id);

		$content->with(['koperasi_detail' => function ($q) {
			$q->orderBy('created_at', 'desc');
		}]);

		if (Input::get('byname')) {
			// $content->whereHas('koperasi_detail', function ($q) use ($tahun) {
			// 	$q->whereYear('tanggal_keadaan', $tahun);
			// });

			// $content->with(['koperasi_detail' => function ($q) use ($tahun) {
			// 	$q->whereYear('tanggal_keadaan', $tahun);
			// }]);

			$content->where('nama_koperasi', 'like', '%' . $byname . '%');
		}

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'byname' => $byname,
		);
		// return $data;
		return view('dashboard.konsultan.koperasi.report', $data);
	}

	public function laporan() {
		$user = Auth::user();

		$byname = Input::get('byname');

		$content = Koperasi::query();

		$content->where('lembaga_id', $user->konsultans->lembaga_id);

		$content->with(['koperasi_detail' => function ($q) {
			$q->orderBy('created_at', 'desc');
		}]);

		if (Input::get('byname')) {
			// $content->whereHas('koperasi_detail', function ($q) use ($tahun) {
			// 	$q->whereYear('tanggal_keadaan', $tahun);
			// });

			// $content->with(['koperasi_detail' => function ($q) use ($tahun) {
			// 	$q->whereYear('tanggal_keadaan', $tahun);
			// }]);

			$content->where('nama_koperasi', 'like', '%' . $byname . '%');
		}

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'byname' => $byname,
		);
		// return $data;
		return view('dashboard.konsultan.koperasi.laporan', $data);
	}

	public function export() {
		$user = Auth::user();

		$byname = Input::get('byname');

		$content = Koperasi::query();

		$content->where('lembaga_id', $user->konsultans->lembaga_id);

		$content->with(['koperasi_detail' => function ($q) {
			$q->orderBy('created_at', 'desc');
		}]);

		if (Input::get('byname')) {
			// $content->whereHas('koperasi_detail', function ($q) use ($tahun) {
			// 	$q->whereYear('tanggal_keadaan', $tahun);
			// });

			// $content->with(['koperasi_detail' => function ($q) use ($tahun) {
			// 	$q->whereYear('tanggal_keadaan', $tahun);
			// }]);

			$content->where('nama_koperasi', 'like', '%' . $byname . '%');
		}

		$data = $content->get();

		if ($data->count() == 0) {
			return redirect('koperasi-laporan')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
		}

		return Excel::create('Data Koperasi ' . date('d-m-Y'), function ($excel) use ($data) {
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
						$sheet->cell('A' . $i, $value->id_koperasi);
						$sheet->cell('B' . $i, $value->nama_koperasi);
						$sheet->cell('C' . $i, $value->alamat);
						$sheet->cell('D' . $i, $value->nomor_badan_hukum . ' / ' . $value->tgl_badan_hukum);
						$sheet->cell('E' . $i, $value->jenis_koperasi);
						$sheet->cell('F' . $i, isset($value->koperasi_detail[0]) ? $value->koperasi_detail[0]->tgl_rat_tahun_buku : '');
						$sheet->cell('G' . $i, isset($value->koperasi_detail[0]) ? $value->koperasi_detail[0]->jml_anggota : '');
						$sheet->cell('H' . $i, isset($value->koperasi_detail[0]) ? $value->koperasi_detail[0]->jml_karyawan : '');
						$sheet->cell('I' . $i, isset($value->koperasi_detail[0]) ? $value->koperasi_detail[0]->jml_asset : '');
						$sheet->cell('J' . $i, isset($value->koperasi_detail[0]) ? $value->koperasi_detail[0]->jml_modal_sendiri : '');
						$sheet->cell('K' . $i, isset($value->koperasi_detail[0]) ? $value->koperasi_detail[0]->jml_modal_luar : '');
						$sheet->cell('L' . $i, isset($value->koperasi_detail[0]) ? $value->koperasi_detail[0]->volume_usaha : '');
						$sheet->cell('M' . $i, isset($value->koperasi_detail[0]) ? $value->koperasi_detail[0]->sisa_hasil : '');
						$sheet->cell('N' . $i, isset($value->koperasi_detail[0]) ? $value->koperasi_detail[0]->kegiatan_usaha : '');
					}
				}
			});
		})->download('xlsx');
	}
}
