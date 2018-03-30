<?php

namespace App\Http\Controllers;

use App\Cis_lembaga;
use App\Kumkm;
use App\KumkmDetail;
use App\Repositories\BidangUsahaRepository;
use App\Repositories\RegenciesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class DataUmkmController extends Controller {
	protected $regencies;
	protected $bidang;

	public function __construct(RegenciesRepository $regenciesRepository, BidangUsahaRepository $bidangUsahaRepository) {
		$this->regencies = $regenciesRepository;
		$this->bidang = $bidangUsahaRepository;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$tahun = Input::get('tahun');
		$lembaga_id = Input::get('lembaga_id');

		$content = Kumkm::query();

		if ($tahun == '') {
			$tahun = date('Y');
		}

		if (Input::get('tahun')) {
			// $content->whereHas('kumkm_detail', function ($q) use ($tahun) {
			//  $q->whereYear('tanggal_keadaan', $tahun);
			// });

			$content->with(['kumkm_detail' => function ($q) use ($tahun) {
				$q->whereYear('tanggal_keadaan', $tahun);
			}]);
		}

		if ($lembaga_id != '') {
			$content->where('lembaga_id', $lembaga_id);
		}

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'tahun' => $tahun,
			'lembaga' => Cis_lembaga::all(),
			'lembaga_id' => $lembaga_id,
		);

		return view('data_umkm.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$data = array(
			'regencies' => $this->regencies->getAll(),
			'bidang_usaha' => $this->bidang->getAll(),
		);
		return view('dashboard.konsultan.kumkm.add', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		// return $request->all();
		$user = Auth::user();
		$lembaga_id = $user->konsultans->lembaga_id;
		$rules = [
			'nama_usaha' => 'required',
			'regency_id' => 'required',
			'alamat' => 'required',
			'tahun_mulai_usaha' => 'required|numeric|date_format:Y',
			'bidang_usaha' => 'required',
			'badan_usaha' => 'required',
			'jml_tenaga_kerja' => 'required|numeric',
			'modal_sendiri' => 'required|numeric',
			'modal_hutang' => 'required|numeric',
			'asset' => 'required|numeric',
			'omset' => 'required|numeric',
			'kegiatan_usaha' => 'required|max:255',
			'tanggal_keadaan' => 'required|date_format:d-m-Y',
		];

		$messages = [
			'nama_usaha.required' => 'Nama UMKM harus terisi',
			'alamat.required' => 'Alamat harus terisi',
			'regency_id.required' => 'Kab/Kota harus terisi',
			'tahun_mulai_usaha.required' => 'Tahun mulai usaha harus terisi',
			'tahun_mulai_usaha.numeric' => 'Tahun mulai usaha harus angka',
			'tahun_mulai_usaha.date_format' => 'Harus format tahun',

			'bidang_usaha.required' => 'Bidang usaha harus terisi',
			'badan_usaha.required' => 'Badan usaha harus terisi',

			'jml_tenaga_kerja.required' => 'Jumlah tenaga kerja harus terisi',
			'jml_tenaga_kerja.numeric' => 'Jumlah tenaga kerja harus angka',

			'asset.required' => 'Jumlah asset harus terisi',
			'asset.numeric' => 'Jumlah asset harus angka',

			'modal_sendiri.required' => 'Jumlah Modal Sendiri harus terisi',
			'modal_sendiri.numeric' => 'Jumlah Modal Sendiri harus angka',

			'modal_hutang.required' => 'Jumlah Modal Luar harus terisi',
			'modal_hutang.numeric' => 'Jumlah Modal Luar harus angka',

			'omset.required' => 'Jumlah Omset Luar harus terisi',
			'omset.numeric' => 'Jumlah Omset Luar harus angka',

			'kegiatan_usaha.required' => 'Kegiatan Usaha harus terisi',
			'kegiatan_usaha.max' => 'Kegiatan Usaha Maks 255 Karakter',
			'tanggal_keadaan.required' => 'Tanggal Keadaan harus terisi',
			'tanggal_keadaan.date_format' => 'Tanggal Keadaan Format DD-MM-TTTT',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return redirect('data-kumkm/create')->withErrors($validator)->withInput();
		}

		$id_kumkm = $request->regency_id . rand(11111111, 99999999);

		$kumkm = new Kumkm();
		$kumkm->id_kumkm = $id_kumkm;
		$kumkm->nama_usaha = $request->nama_usaha;
		$kumkm->alamat = $request->alamat;
		$kumkm->tgl_mulai_usaha = $request->tahun_mulai_usaha;
		$kumkm->bidang_usaha = $request->bidang_usaha;
		$kumkm->badan_usaha = $request->badan_usaha;
		$kumkm->regency_id = $request->regency_id;
		$kumkm->lembaga_id = $lembaga_id;
		$kumkm->save();

		// return $kumkm;

		if ($kumkm) {
			$kumkm_detail = new KumkmDetail();
			$kumkm_detail->kumkm_id = $kumkm->id;
			$kumkm_detail->jml_tenaga_kerja = $request->jml_tenaga_kerja;
			$kumkm_detail->asset = $request->asset;
			$kumkm_detail->modal_sendiri = $request->modal_sendiri;
			$kumkm_detail->modal_hutang = $request->modal_hutang;
			$kumkm_detail->omset = $request->omset;
			$kumkm_detail->kegiatan_usaha = $request->kegiatan_usaha;
			$kumkm_detail->tanggal_keadaan = date('Y-m-d', strtotime($request->tanggal_keadaan));
			$kumkm_detail->save();
		}

		if ($kumkm_detail) {
			return redirect('data-kumkm')->with('success', 'Data UMKM Berhasil disimpan');
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
			'data' => Kumkm::where('lembaga_id', $lembaga_id)->where('id', $id)->first(),
		);
		return view('dashboard.konsultan.kumkm.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$data = array(
			'data' => Kumkm::find($id),
			'regencies' => $this->regencies->getAll(),
			'bidang_usaha' => $this->bidang->getAll(),
		);
		return view('dashboard.konsultan.kumkm.edit', $data);
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
			'nama_usaha' => 'required',
			'regency_id' => 'required',
			'alamat' => 'required',
			'tahun_mulai_usaha' => 'required|numeric|date_format:Y',
			'bidang_usaha' => 'required',
			'badan_usaha' => 'required',
		];

		$messages = [
			'nama_usaha.required' => 'Nama UMKM harus terisi',
			'alamat.required' => 'Alamat harus terisi',
			'regency_id.required' => 'Kab/Kota harus terisi',
			'tahun_mulai_usaha.required' => 'Tahun mulai usaha harus terisi',
			'tahun_mulai_usaha.numeric' => 'Tahun mulai usaha harus angka',
			'tahun_mulai_usaha.date_format' => 'Format tahun 4 digit',

			'bidang_usaha.required' => 'Bidang usaha harus terisi',
			'badan_usaha.required' => 'Badan usaha harus terisi',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return redirect('data-kumkm/' . $id . '/edit')->withErrors($validator)->withInput();
		}

		$kumkm = Kumkm::find($id);
		$kumkm->nama_usaha = $request->nama_usaha;
		$kumkm->alamat = $request->alamat;
		$kumkm->tgl_mulai_usaha = $request->tahun_mulai_usaha;
		$kumkm->bidang_usaha = $request->bidang_usaha;
		$kumkm->badan_usaha = $request->badan_usaha;
		$kumkm->regency_id = $request->regency_id;
		$kumkm->save();

		if ($kumkm) {
			return redirect('data-kumkm/' . $id)->with('success', 'Data UMKM Berhasil Diupdate');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$data = Kumkm::find($id);
		$data->delete();

		if ($data) {
			return redirect('database-umkm')->with('success', 'Data UMKM Berhasil dihapus');
		}
	}

	public function hapus(Request $request) {
		// return $request->koperasi_id;
		$koperasi_id = $request->umkm_id;

		$jml = 0;
		$gagal = 0;

		if (!$koperasi_id) {
			return redirect('database-umkm')->with('error', 'Pastikan Memilih data UMKM nya. Harus Teliti lagi ! ');
		}

		foreach ($koperasi_id as $key => $value) {
			$kop = Kumkm::find($value);
			if ($kop) {
				$kop->delete();
				if ($kop) {
					$jml++;
				}
			} else {
				$gagal++;
			}
		}

		return redirect('database-umkm')->with('info', $jml . ' Data Terhapus, Gagal Sebanyak ' . $gagal);
	}

	public function addDetail($kumkm_id) {
		$user = Auth::user();
		$lembaga_id = $user->konsultans->lembaga_id;

		$kop = Kumkm::where('lembaga_id', $lembaga_id)->where('id', $kumkm_id)->count();

		if (!$kop > 0) {
			return redirect('data-kumkm')->with('success', 'Maaf tidak bisa hubungi Administrator');
		}

		$data = array(
			'data' => Kumkm::find($kumkm_id),
		);

		return view('dashboard.konsultan.kumkm.add_detail', $data);
	}

	public function editDetail($kumkm_id, $id) {
		$data = array(
			'data' => KumkmDetail::where('kumkm_id', $kumkm_id)->where('id', $id)->first(),
		);
		return view('dashboard.konsultan.kumkm.edit_detail', $data);
	}

	public function doAddDetail(Request $request) {
		$user = Auth::user();
		$rules = [
			'jml_tenaga_kerja' => 'required|numeric',
			'modal_sendiri' => 'required|numeric',
			'modal_hutang' => 'required|numeric',
			'asset' => 'required|numeric',
			'omset' => 'required|numeric',
			'kegiatan_usaha' => 'required',
			'tanggal_keadaan' => 'required|date_format:d-m-Y',
		];

		$messages = [
			'jml_tenaga_kerja.required' => 'Jumlah tenaga kerja harus terisi',
			'jml_tenaga_kerja.numeric' => 'Jumlah tenaga kerja harus angka',

			'asset.required' => 'Jumlah asset harus terisi',
			'asset.numeric' => 'Jumlah asset harus angka',

			'modal_sendiri.required' => 'Jumlah Modal Sendiri harus terisi',
			'modal_sendiri.numeric' => 'Jumlah Modal Sendiri harus angka',

			'modal_hutang.required' => 'Jumlah Modal Luar harus terisi',
			'modal_hutang.numeric' => 'Jumlah Modal Luar harus angka',

			'omset.required' => 'Jumlah Omset Luar harus terisi',
			'omset.numeric' => 'Jumlah Omset Luar harus angka',

			'kegiatan_usaha.required' => 'Kegiatan Usaha harus terisi',
			'tanggal_keadaan.required' => 'Tanggal Keadaan harus terisi',
			'tanggal_keadaan.date_format' => 'Tanggal Keadaan Format DD-MM-TTTT',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return redirect('data-kumkm-detail-add/' . $request->kumkm_id)->withErrors($validator)->withInput();
		}

		$tahun_detail = date('Y', strtotime($request->tanggal_keadaan));

		$datakumkm = KumkmDetail::where('kumkm_id', $request->kumkm_id)->whereYear('tanggal_keadaan', $tahun_detail)->count();

		if ($datakumkm > 0) {
			return redirect('data-kumkm-detail-add/' . $request->kumkm_id)->with('error', 'Data tahun ' . $tahun_detail . ' sudah ada, silahkan diupdate data yang sudah ada !! ')->withInput();
		}

		$kumkm_detail = new KumkmDetail();
		$kumkm_detail->kumkm_id = $request->kumkm_id;
		$kumkm_detail->jml_tenaga_kerja = $request->jml_tenaga_kerja;
		$kumkm_detail->asset = $request->asset;
		$kumkm_detail->modal_sendiri = $request->modal_sendiri;
		$kumkm_detail->modal_hutang = $request->modal_hutang;
		$kumkm_detail->omset = $request->omset;
		$kumkm_detail->kegiatan_usaha = $request->kegiatan_usaha;
		$kumkm_detail->tanggal_keadaan = date('Y-m-d', strtotime($request->tanggal_keadaan));
		$kumkm_detail->save();

		if ($kumkm_detail) {
			return redirect('data-kumkm/' . $request->kumkm_id)->with('success', 'Detail KUMKM Berhasil di tambahkan');
		}
	}

	public function doEditDetail(Request $request, $kumkm_id, $id) {
		$user = Auth::user();
		$rules = [
			'jml_tenaga_kerja' => 'required|numeric',
			'modal_sendiri' => 'required|numeric',
			'modal_hutang' => 'required|numeric',
			'asset' => 'required|numeric',
			'omset' => 'required|numeric',
			'kegiatan_usaha' => 'required|max:255',
			'tanggal_keadaan' => 'required|date_format:d-m-Y',
		];

		$messages = [
			'jml_tenaga_kerja.required' => 'Jumlah tenaga kerja harus terisi',
			'jml_tenaga_kerja.numeric' => 'Jumlah tenaga kerja harus angka',

			'asset.required' => 'Jumlah asset harus terisi',
			'asset.numeric' => 'Jumlah asset harus angka',

			'modal_sendiri.required' => 'Jumlah Modal Sendiri harus terisi',
			'modal_sendiri.numeric' => 'Jumlah Modal Sendiri harus angka',

			'modal_hutang.required' => 'Jumlah Modal Luar harus terisi',
			'modal_hutang.numeric' => 'Jumlah Modal Luar harus angka',

			'omset.required' => 'Jumlah Omset Luar harus terisi',
			'omset.numeric' => 'Jumlah Omset Luar harus angka',

			'kegiatan_usaha.required' => 'Kegiatan Usaha harus terisi',
			'kegiatan_usaha.max' => 'Kegiatan Usaha Maks 255 Karakter',
			'tanggal_keadaan.required' => 'Tanggal Keadaan harus terisi',
			'tanggal_keadaan.date_format' => 'Tanggal Keadaan Format DD-MM-TTTT',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return redirect('data-kumkm-detail-edit/' . $kumkm_id . '/' . $id)->withErrors($validator)->withInput();
		}

		$tahun_detail = date('Y', strtotime($request->tanggal_keadaan));

		$datakumkm = KumkmDetail::where('kumkm_id', $kumkm_id)->whereYear('tanggal_keadaan', $tahun_detail)->whereNotIn('id', [$id])->count();

		if ($datakumkm > 0) {
			return redirect('data-kumkm-detail-edit/' . $kumkm_id . '/' . $id)->with('error', 'Data tahun ' . $tahun_detail . ' sudah ada, silahkan diupdate !! ')->withInput();
		}

		$kumkm_detail = KumkmDetail::find($id);
		$kumkm_detail->jml_tenaga_kerja = $request->jml_tenaga_kerja;
		$kumkm_detail->asset = $request->asset;
		$kumkm_detail->modal_sendiri = $request->modal_sendiri;
		$kumkm_detail->modal_hutang = $request->modal_hutang;
		$kumkm_detail->omset = $request->omset;
		$kumkm_detail->kegiatan_usaha = $request->kegiatan_usaha;
		$kumkm_detail->tanggal_keadaan = date('Y-m-d', strtotime($request->tanggal_keadaan));
		$kumkm_detail->save();

		if ($kumkm_detail) {
			return redirect('data-kumkm/' . $kumkm_id)->with('success', 'Detail UMKM Berhasil di update');
		}
	}

	public function delDetail($id) {
		$data = KumkmDetail::find($id);
		$kumkm_id = $data->kumkm_id;
		$data->delete();
		if ($data) {
			return redirect('data-kumkm/' . $kumkm_id)->with('success', 'Detail UMKM Berhasil dihapus');
		}
	}

	public function report() {
		$user = Auth::user();

		$tahun = Input::get('tahun');

		$content = Kumkm::query();

		$content->where('lembaga_id', $user->konsultans->lembaga_id);

		if ($tahun == '') {
			$tahun = date('Y');
		}

		if (Input::get('tahun')) {
			// $content->whereHas('kumkm_detail', function ($q) use ($tahun) {
			//  $q->whereYear('tanggal_keadaan', $tahun);
			// });

			$content->with(['kumkm_detail' => function ($q) use ($tahun) {
				$q->whereYear('tanggal_keadaan', $tahun);
			}]);
		}

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'tahun' => $tahun,
		);
		// return $data;
		return view('dashboard.konsultan.kumkm.report', $data);
	}

	public function laporan() {
		$tahun = Input::get('tahun');
		$lembaga_id = Input::get('lembaga_id');

		$content = Kumkm::query();

		if ($tahun == '') {
			$tahun = date('Y');
		}

		if (Input::get('tahun')) {
			// $content->whereHas('kumkm_detail', function ($q) use ($tahun) {
			//  $q->whereYear('tanggal_keadaan', $tahun);
			// });

			$content->with(['kumkm_detail' => function ($q) use ($tahun) {
				$q->whereYear('tanggal_keadaan', $tahun);
			}]);
		}

		if ($lembaga_id != '') {
			$content->where('lembaga_id', $lembaga_id);
		}

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'tahun' => $tahun,
			'lembaga' => Cis_lembaga::all(),
			'lembaga_id' => $lembaga_id,
		);
		// return $data;
		return view('data_umkm.laporan', $data);
	}

	public function export() {
		$tahun = Input::get('tahun');
		$lembaga_id = Input::get('lembaga_id');

		$nama_lembaga = '';

		$content = Kumkm::query();

		if ($tahun == '') {
			$tahun = date('Y');
		}

		if (Input::get('tahun')) {
			// $content->whereHas('kumkm_detail', function ($q) use ($tahun) {
			//  $q->whereYear('tanggal_keadaan', $tahun);
			// });

			$content->with(['kumkm_detail' => function ($q) use ($tahun) {
				$q->whereYear('tanggal_keadaan', $tahun);
			}]);
		}

		if ($lembaga_id != '') {
			$content->where('lembaga_id', $lembaga_id);
			$lembagarow = Cis_lembaga::find($lembaga_id);

			$nama_lembaga = $lembagarow->plut_name;
		}

		$data = $content->get();

		if ($data->count() == 0) {
			return redirect('data-kumkm-laporan')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
		}

		return Excel::create('Data UMKM ' . $nama_lembaga . ' ' . $tahun, function ($excel) use ($data) {
			$excel->sheet('mySheet', function ($sheet) use ($data) {
				$sheet->cell('A1', function ($cell) {$cell->setValue('Lembaga');});
				$sheet->cell('B1', function ($cell) {$cell->setValue('ID UMKM');});
				$sheet->cell('C1', function ($cell) {$cell->setValue('Nama UMKM');});
				$sheet->cell('D1', function ($cell) {$cell->setValue('Alamat');});
				$sheet->cell('E1', function ($cell) {$cell->setValue('Tahun Mulai Usaha');});
				$sheet->cell('F1', function ($cell) {$cell->setValue('Jenis Usaha');});
				$sheet->cell('G1', function ($cell) {$cell->setValue('Legalitas');});
				$sheet->cell('H1', function ($cell) {$cell->setValue('Tenaga Kerja (Orang)');});
				$sheet->cell('I1', function ($cell) {$cell->setValue('Modal Sendiri');});
				$sheet->cell('J1', function ($cell) {$cell->setValue('Modal Luar');});
				$sheet->cell('K1', function ($cell) {$cell->setValue('Asset');});
				$sheet->cell('L1', function ($cell) {$cell->setValue('Omset');});
				$sheet->cell('M1', function ($cell) {$cell->setValue('Kegiatan Usaha');});

				if (!empty($data)) {
					foreach ($data as $key => $value) {
						$i = $key + 2;
						$sheet->cell('A' . $i, $value->lembaga->plut_name);
						$sheet->cell('B' . $i, $value->id_kumkm);
						$sheet->cell('C' . $i, $value->nama_usaha);
						$sheet->cell('D' . $i, $value->alamat);
						$sheet->cell('E' . $i, $value->tgl_mulai_usaha);
						$sheet->cell('F' . $i, $value->bidangusaha ? $value->bidangusaha->name : '');
						$sheet->cell('G' . $i, $value->badan_usaha);
						$sheet->cell('H' . $i, isset($value->kumkm_detail[0]) ? $value->kumkm_detail[0]->jml_tenaga_kerja : '');
						$sheet->cell('I' . $i, isset($value->kumkm_detail[0]) ? $value->kumkm_detail[0]->modal_sendiri : '');
						$sheet->cell('J' . $i, isset($value->kumkm_detail[0]) ? $value->kumkm_detail[0]->modal_hutang : '');
						$sheet->cell('K' . $i, isset($value->kumkm_detail[0]) ? $value->kumkm_detail[0]->asset : '');
						$sheet->cell('L' . $i, isset($value->kumkm_detail[0]) ? $value->kumkm_detail[0]->omset : '');
						$sheet->cell('M' . $i, isset($value->kumkm_detail[0]) ? $value->kumkm_detail[0]->kegiatan_usaha : '');
					}
				}
			});
		})->download('xlsx');
	}
}
