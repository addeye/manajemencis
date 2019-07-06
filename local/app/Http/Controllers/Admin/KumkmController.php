<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kumkm;
use App\KumkmDetail;
use App\Repositories\BidangUsahaRepository;
use App\Repositories\RegenciesRepository;
use App\SasaranProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class KumkmController extends Controller {
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
		$user = Auth::user();

		$byname = Input::get('byname');

		$content = Kumkm::query();

		$content->where('lembaga_id', $user->adminlembagas->lembaga_id);

		$content->with(['kumkm_detail' => function ($q) {
			$q->orderBy('created_at', 'desc');
		}]);

		if (Input::get('byname')) {
			// $content->whereHas('kumkm_detail', function ($q) use ($tahun) {
			// 	$q->whereYear('tanggal_keadaan', $tahun);
			// });

			// $content->with(['kumkm_detail' => function ($q) use ($tahun) {
			// 	$q->whereYear('tanggal_keadaan', $tahun);
			// }]);

			$content->where('nama_usaha', 'like', '%' . $byname . '%');
		}

		$content = $content->paginate();

		$data = array(
			'data' => $content,
			'byname' => $byname,
		);

		return view('dashboard.admin.kumkm.list', $data);
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
		return view('dashboard.admin.kumkm.add', $data);
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
		$lembaga_id = $user->adminlembagas->lembaga_id;
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
			return redirect('adm/data-kumkm/create')->withErrors($validator)->withInput();
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
			return redirect('adm/data-kumkm')->with('success', 'Data UMKM Berhasil disimpan');
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
		$lembaga_id = $user->adminlembagas->lembaga_id;

		$data = array(
			'data' => Kumkm::where('lembaga_id', $lembaga_id)->where('id', $id)->first(),
		);
		return view('dashboard.admin.kumkm.show', $data);
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
		return view('dashboard.admin.kumkm.edit', $data);
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
			return redirect('adm/data-kumkm/' . $id . '/edit')->withErrors($validator)->withInput();
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
			return redirect('adm/data-kumkm/' . $id)->with('success', 'Data UMKM Berhasil Diupdate');
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

		$sasaran_count = SasaranProgram::where('ukmtable_id', $id)->where('ukmtable_type', 'kumkm')->count();
		if ($sasaran_count != 0) {
			return redirect('adm/data-kumkm/' . $id)->with('error', 'Data UMKM Sudah Terdaftar Sebagai Sasaran Program. Hapus Dari Sasaran Program Dahulu atau Hubungi Super Admin');
		}

		$data->delete();

		if ($data) {
			return redirect('adm/data-kumkm')->with('success', 'Data UMKM Berhasil dihapus');
		}
	}

	public function addDetail($kumkm_id) {
		$user = Auth::user();
		$lembaga_id = $user->adminlembagas->lembaga_id;

		$kop = Kumkm::where('lembaga_id', $lembaga_id)->where('id', $kumkm_id)->count();

		if (!$kop > 0) {
			return redirect('adm/data-kumkm')->with('success', 'Maaf tidak bisa hubungi Administrator');
		}

		$data = array(
			'data' => Kumkm::find($kumkm_id),
		);

		return view('dashboard.admin.kumkm.add_detail', $data);
	}

	public function editDetail($kumkm_id, $id) {
		$data = array(
			'data' => KumkmDetail::where('kumkm_id', $kumkm_id)->where('id', $id)->first(),
		);
		return view('dashboard.admin.kumkm.edit_detail', $data);
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
			return redirect('adm/data-kumkm-detail-add/' . $request->kumkm_id)->withErrors($validator)->withInput();
		}

		$tahun_detail = date('Y', strtotime($request->tanggal_keadaan));

		$datakumkm = KumkmDetail::where('kumkm_id', $request->kumkm_id)->whereYear('tanggal_keadaan', $tahun_detail)->count();

		if ($datakumkm > 0) {
			return redirect('adm/data-kumkm-detail-add/' . $request->kumkm_id)->with('error', 'Data tahun ' . $tahun_detail . ' sudah ada, silahkan diupdate data yang sudah ada !! ')->withInput();
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
			return redirect('adm/data-kumkm/' . $request->kumkm_id)->with('success', 'Detail KUMKM Berhasil di tambahkan');
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
			return redirect('adm/data-kumkm-detail-edit/' . $kumkm_id . '/' . $id)->withErrors($validator)->withInput();
		}

		$tahun_detail = date('Y', strtotime($request->tanggal_keadaan));

		$datakumkm = KumkmDetail::where('kumkm_id', $kumkm_id)->whereYear('tanggal_keadaan', $tahun_detail)->whereNotIn('id', [$id])->count();

		if ($datakumkm > 0) {
			return redirect('adm/data-kumkm-detail-edit/' . $kumkm_id . '/' . $id)->with('error', 'Data tahun ' . $tahun_detail . ' sudah ada, silahkan diupdate !! ')->withInput();
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
			return redirect('adm/data-kumkm/' . $kumkm_id)->with('success', 'Detail UMKM Berhasil di update');
		}
	}

	public function delDetail($id) {
		$data = KumkmDetail::find($id);
		$kumkm_id = $data->kumkm_id;

		$kumkm_detail_count = KumkmDetail::where('kumkm_id', $kumkm_id)->count();

		$sasaran_count = SasaranProgram::where('ukmtable_id', $kumkm_id)->where('ukmtable_type', 'kumkm')->count();

		if ($sasaran_count != 0 AND $kumkm_detail_count == 1) {
			return redirect('adm/data-kumkm/' . $kumkm_id)->with('error', 'Data UMKM Sudah Terdaftar Sebagai Sasaran Program. Hapus Dari Sasaran Program Dahulu atau Hubungi Super Admin');
		}

		$data->delete();
		if ($data) {
			return redirect('adm/data-kumkm/' . $kumkm_id)->with('success', 'Detail UMKM Berhasil dihapus');
		}
	}

	public function report() {
		$user = Auth::user();

		$tahun = Input::get('tahun');

		$content = Kumkm::query();

		$content->where('lembaga_id', $user->adminlembagas->lembaga_id);

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
		return view('dashboard.admin.kumkm.report', $data);
	}

	public function laporan() {
		$user = Auth::user();

		$tahun = Input::get('tahun');

		$content = Kumkm::query();

		$content->where('lembaga_id', $user->adminlembagas->lembaga_id);

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
		return view('dashboard.admin.kumkm.laporan', $data);
	}

	public function export() {
		$user = Auth::user();

		$tahun = Input::get('tahun');

		$content = Kumkm::query();

		$content->where('lembaga_id', $user->adminlembagas->lembaga_id);

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

		$data = $content->get();

		if ($data->count() == 0) {
			return redirect('adm/data-kumkm-laporan')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
		}

		return Excel::create('Data UMKM ' . $tahun, function ($excel) use ($data) {
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
						$sheet->cell('A' . $i, $value->id_kumkm);
						$sheet->cell('B' . $i, $value->nama_usaha);
						$sheet->cell('C' . $i, $value->alamat);
						$sheet->cell('D' . $i, $value->tgl_mulai_usaha);
						$sheet->cell('E' . $i, $value->bidangusaha ? $value->bidangusaha->name : '');
						$sheet->cell('F' . $i, $value->badan_usaha);
						$sheet->cell('G' . $i, isset($value->kumkm_detail[0]) ? $value->kumkm_detail[0]->jml_tenaga_kerja : '');
						$sheet->cell('H' . $i, isset($value->kumkm_detail[0]) ? $value->kumkm_detail[0]->modal_sendiri : '');
						$sheet->cell('I' . $i, isset($value->kumkm_detail[0]) ? $value->kumkm_detail[0]->modal_hutang : '');
						$sheet->cell('J' . $i, isset($value->kumkm_detail[0]) ? $value->kumkm_detail[0]->asset : '');
						$sheet->cell('K' . $i, isset($value->kumkm_detail[0]) ? $value->kumkm_detail[0]->omset : '');
						$sheet->cell('L' . $i, isset($value->kumkm_detail[0]) ? $value->kumkm_detail[0]->kegiatan_usaha : '');
					}
				}
			});
		})->download('xlsx');
	}
}
