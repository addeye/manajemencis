<?php

namespace App\Http\Controllers;

use App\Cis_lembaga;
use App\Proker_konsultan;
use App\Repositories\AdminLembagaRepository;
use App\Repositories\CisLembagaRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AdminLembagaController extends Controller {
	protected $lembaga;
	protected $adminlembaga;
	protected $user;

	public function __construct(CisLembagaRepository $lembaga,
		AdminLembagaRepository $adminlembaga, UserRepository $user) {
		$this->lembaga = $lembaga;
		$this->adminlembaga = $adminlembaga;
		$this->user = $user;
	}

	public function getAll() {
		$data = array(
			'head_title' => 'Admin',
			'title' => 'Data Admin Lembaga',
			'data' => $this->adminlembaga->getAll(),
		);

		return view('admin_lembaga.list', $data);
	}

	public function addData() {
		$data = array(
			'head_title' => 'Admin',
			'title' => 'Tambah Admin Lembaga',
			'lembaga' => $this->lembaga->getAll(),
		);

		return view('admin_lembaga.add', $data);
	}

	public function editData($id) {
		$data = array(
			'head_title' => 'Admin',
			'title' => 'Edit Admin Lembaga',
			'lembaga' => $this->lembaga->getAll(),
			'data' => $this->adminlembaga->getById($id),
		);

		return view('admin_lembaga.edit', $data);

	}

	public function doAddData(Request $request) {
		$data = $request->all();
		$validator = Validator::make($request->all(), [
			'nama_lengkap' => 'required',
			'email' => 'required|email|unique:users',
		]);

		if ($validator->fails()) {
			return redirect('admin/create')
				->withErrors($validator)
				->withInput();
		}

		$result = $this->adminlembaga->create($data);
		if ($result) {
			return redirect('admin')->with('success', 'Data Admin Lembaga Berhasil Disimpan');
		}
	}

	public function doEditData(Request $request, $id) {
		$data = $request->all();
		$result = $this->adminlembaga->update($id, $data);
		if ($result) {
			return redirect('admin')->with('info', 'Data Admin Lembaga Berhasil Diupdate');
		}
	}

	public function deleteData($id) {
		$result = $this->adminlembaga->delete($id);
		if ($result) {
			return redirect('admin')->with('info', 'Data Admin Lembaga Berhasil Dihapus');
		}
	}

	public function prokerPlut() {
		$lembaga_id = Input::get('lembaga_id');

		$content = Proker_konsultan::query();

		$content->where('lembaga_id', '!=', NULL)->where('tahun_kegiatan', '>', '2017');

		if ($lembaga_id != 'semua') {
			if (Input::get('lembaga_id')) {
				$content->where('lembaga_id', $lembaga_id);
			}
		}

		$content = $content->paginate();

		$data = Array
			(
			'title' => 'Data Program Kerja PLUT KUMKM',
			'data' => $content,
			'lembaga' => Cis_lembaga::all(),
			'lembaga_id' => $lembaga_id,
		);
		// return $data;
		return view('proker.proker_plut', $data);
	}

	public function statusProkerPlut($id, $status) {
		$status_lock = '';
		if ($status == 'Yes') {
			$status_lock = 'No';
		} elseif ($status == 'No') {
			$status_lock = 'Yes';
		}
		$data = Proker_konsultan::find($id);
		$data->status_lock = $status_lock;
		$data->save();

		if ($data) {
			return redirect('proker-plut')->with('success', 'Status proker berhasil dirubah');
		}
	}
}
