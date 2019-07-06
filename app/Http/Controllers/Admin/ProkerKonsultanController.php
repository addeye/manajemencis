<?php

namespace App\Http\Controllers\Admin;

use App\Details_proker;
use App\Http\Controllers\Controller;
use App\Konsultan;
use App\Repositories\DetailsProkersRepository;
use App\Repositories\ProkerKonsultanRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ProkerKonsultanController extends Controller {
	protected $proker;
	protected $detailproker;

	public function __construct(ProkerKonsultanRepository $proker, DetailsProkersRepository $detailproker) {
		$this->proker = $proker;
		$this->detailproker = $detailproker;
	}
	public function index() {
		$user = Auth::user();
		$lembaga_id = $user->adminlembagas->lembaga_id;

		$proker_id = Input::get('proker_id');
		$konsultan_id = Input::get('konsultan_id');

		$content = Details_proker::query();

		$content->whereHas('prokers', function ($q) use ($lembaga_id) {
			$q->where('lembaga_id', $lembaga_id)->where('tahun_kegiatan', date('Y'));
		});

		if (Input::get('proker_id')) {
			$content->where('proker_id', $proker_id);
		}

		if (Input::get('konsultan_id')) {
			$content->where('konsultan_id', $konsultan_id);
		}

		$content = $content->paginate();

		$data = Array
			(
			'title' => 'Data Program Kerja',
			'data' => $content,
			'proker' => $this->proker->getAllByLembagaIdLock($user->adminlembagas->lembaga_id),
			'proker_id' => $proker_id,
			'konsultan' => Konsultan::where('lembaga_id', $user->adminlembagas->lembaga_id)->get(),
			'konsultan_id' => $konsultan_id,
		);

		return view('dashboard.admin.proker.list', $data);
	}

	public function getProkerKonsultan() {
		$user = Auth::user();
		$lembaga_id = $user->adminlembagas->lembaga_id;

		$proker_id = Input::get('proker_id');

		$content = Details_proker::query();

		$content->whereHas('prokers', function ($q) use ($lembaga_id) {
			$q->where('lembaga_id', $lembaga_id)->where('tahun_kegiatan', date('Y'));
		});

		if (Input::get('proker_id')) {
			$content->where('proker_id', $proker_id);
		}

		$content = $content->paginate();

		$data = Array
			(
			'title' => 'Data Program Kerja',
			'data' => $content,
			'proker' => $this->proker->getAllByLembagaIdLock($user->adminlembagas->lembaga_id),
			'proker_id' => $proker_id,
		);

		return view('dashboard.admin.proker.list', $data);
	}

	public function view() {
		$user = Auth::user();
		$lembaga_id = $user->adminlembagas->lembaga_id;

		$proker_id = Input::get('proker_id');

		$content = Details_proker::query();

		$content->whereHas('prokers', function ($q) use ($lembaga_id) {
			$q->where('lembaga_id', $lembaga_id)->where('tahun_kegiatan', date('Y'));
		});

		if (Input::get('proker_id')) {
			$content->where('proker_id', $proker_id);
		}

		$content = $content->paginate();

		$data = Array
			(
			'title' => 'Data Program Kerja',
			'data' => $content,
			'proker' => $this->proker->getAllByLembagaIdLock($user->adminlembagas->lembaga_id),
			'proker_id' => $proker_id,
		);
		// return $data;
		return view('dashboard.admin.proker.view', $data);
	}

	public function report() {

	}
}
