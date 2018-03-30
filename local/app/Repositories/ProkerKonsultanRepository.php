<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 04/02/2017
 * Time: 1:53
 */

namespace App\Repositories;

use App\Proker_konsultan;
use Illuminate\Support\Facades\Auth;

class ProkerKonsultanRepository {
	// Select All
	Public function getAll() {
		return Proker_konsultan::all();
	}

	public function getAllByKonsultan() {
		return Proker_konsultan::where('konsultan_id', Auth::user()->konsultans->id)->orderBy('tahun_kegiatan', 'DESC')->get();
	}

	public function getAllByKonsultanId($id) {
		return Proker_konsultan::where('konsultan_id', $id)->get();
	}

	public function getAllByLembagaId($lembaga_id) {
		return Proker_konsultan::where('lembaga_id', $lembaga_id)->get();
	}

	public function getAllByLembagaIdLock($lembaga_id) {
		return Proker_konsultan::where('lembaga_id', $lembaga_id)->where('status_lock', 'Yes')->get();
	}

	// Select where id
	public function getById($id) {
		return Proker_konsultan::find($id);
	}

	// Insert into
	public function create($data = array()) {
		$data['konsultan_id'] = Auth::user()->konsultans->id;
		$result = Proker_konsultan::create($data);
		if ($result) {
			return true;
		}

		return false;
	}

	// Update
	public function update($id, $data = array()) {
		$result = Proker_konsultan::find($id)->update($data);
		if ($result) {
			return true;
		}

		return false;
	}

	// Delete
	public function delete($id) {
		$result = Proker_konsultan::destroy($id);
		if ($result) {
			return true;
		}
		return false;
	}
}