<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BidangUsahaRepository;
use App\Repositories\CisLembagaRepository;
use App\Repositories\DistrictsRepository;
use App\Repositories\LembagaRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use App\Repositories\SentraKumkmRepository;
use App\Repositories\VillagesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SentraKumkmController extends Controller {
	protected $sentrakumkm;
	protected $provinces;
	protected $regencies;
	protected $disticts;
	protected $villages;
	protected $lembaga;
	protected $bidangusaha;
	protected $cislembaga;

	public function __construct(SentraKumkmRepository $sentrakumkm,
		ProvincesRepository $provinces,
		RegenciesRepository $regencies,
		DistrictsRepository $disticts,
		VillagesRepository $villages,
		LembagaRepository $lembaga,
		BidangUsahaRepository $bidangusaha,
		CisLembagaRepository $cisLembagaRepository) {
		$this->sentrakumkm = $sentrakumkm;
		$this->provinces = $provinces;
		$this->regencies = $regencies;
		$this->disticts = $disticts;
		$this->villages = $villages;
		$this->lembaga = $lembaga;
		$this->bidangusaha = $bidangusaha;
		$this->cislembaga = $cisLembagaRepository;
	}

	public function getAll() {
		$data = array(
			'head_title' => 'Sentra KUMKM',
			'title' => 'Data Sentra KUMKM',
			'data' => $this->sentrakumkm->getSentraByAdmin(),
		);

		return view('dashboard.admin.sentra_kumkm.list', $data);
	}

	public function addData() {
		$lembaga_id = Auth::user()->adminlembagas->lembaga_id;
		$datalembaga = $this->cislembaga->getById($lembaga_id);
		$provinces_id = $datalembaga ? $datalembaga->provinces_id : '0';
		$data = array(
			'head_title' => 'Sentra UMKM',
			'title' => 'Tambah Data Sentra UMKM',
			'regencies' => $this->regencies->getByProvinces($provinces_id),
			'bidangusaha' => $this->bidangusaha->getAll(),
			'admin_lembagas' => $lembaga_id,
			'data_lembaga' => $datalembaga,
		);
//        return $data;

		return view('dashboard.admin.sentra_kumkm.add', $data);
	}

	public function editData($id) {
		$rowsentra = $this->sentrakumkm->getById($id);
		$lembaga_id = Auth::user()->adminlembagas->lembaga_id;
		$datalembaga = $this->cislembaga->getById($lembaga_id);
		$data = array(
			'head_title' => 'Sentra UMKM',
			'title' => 'Tambah Data Sentra UMKM',
			'regencies' => $this->regencies->getByProvinces($rowsentra->provinces_id),
			'districts' => $this->disticts->getByRegencies($rowsentra->regency_id),
			'villages' => $this->villages->getByDistrict($rowsentra->district_id),
			'bidangusaha' => $this->bidangusaha->getAll(),
			'admin_lembagas' => $lembaga_id,
			'data_lembaga' => $datalembaga,
			'data' => $rowsentra,
		);

		return view('dashboard.admin.sentra_kumkm.edit', $data);
	}

	public function doAddData(Request $request) {
		$data = $request->all();
		$id_lembaga = Auth::user()->adminlembagas->lembaga_id;
		$datalembaga = $this->cislembaga->getById($id_lembaga);
		$data['id_lembaga'] = $id_lembaga;
		$data['provinces_id'] = $datalembaga->provinces_id;
//        return $data;
		$result = $this->sentrakumkm->create($data);
		if ($result) {
			return redirect('adm/sentra')->with('success', 'Data Sentra KUMKM Berhasil Disimpan');
		}
	}

	public function doEditData(Request $request, $id) {
		$data = $request->all();
		$result = $this->sentrakumkm->update($id, $data);
		if ($result) {
			return redirect('sentra')->with('info', 'Data Sentra KUMKM Berhasil Diupdate');
		}
	}

	public function deleteData($id) {
		$result = $this->sentrakumkm->delete($id);
		if ($result) {
			return redirect('sentra')->with('info', 'Data Sentra KUMKM Berhasil Dihapus');
		}
	}

	public function getAllColumn() {
		$data = array(
			'head_title' => 'Sentra KUMKM',
			'title' => 'Laporan Sentra KUMKM',
			'data' => $this->sentrakumkm->getSentraByAdmin(),
		);
		return view('dashboard.admin.sentra_kumkm.report', $data);
	}
}
