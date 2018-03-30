<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 04/02/2017
 * Time: 11:34
 */

namespace App\Repositories;

use App\Kegiatan_konsultan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KegiatanKonsultanRepository {
	// Select All
	public function getAll() {
		return Kegiatan_konsultan::all();
	}

	public function getAllByYear($year = '') {
		if (is_null($year)) {
			$year = date('Y');
		}

		return Kegiatan_konsultan::whereYear('tanggal_mulai', $year)->get();
	}

	public function getAllByKonsultan($year = null) {
		if (!is_null($year)) {
			return Kegiatan_konsultan::where('konsultan_id', Auth::user()->konsultans->id)->whereYear('tanggal_mulai', $year)->get();
		}
		return Kegiatan_konsultan::where('konsultan_id', Auth::user()->konsultans->id)->whereYear('tanggal_mulai', date('Y'))->get();
	}

	// Select where id
	public function getById($id) {
		return Kegiatan_konsultan::find($id);
	}

	// Insert into
	public function create($data = array()) {
		$data['konsultan_id'] = Auth::user()->konsultans->id;

		$data['tanggal_mulai'] = date('Y-m-d', strtotime($data['tanggal_mulai']));
		$data['tanggal_selesai'] = date('Y-m-d', strtotime($data['tanggal_selesai']));

		$result = Kegiatan_konsultan::create($data);
		if ($result) {
			return $result;
		}

		return false;
	}

	// Update
	public function update($id, $data = array()) {

		$data['tanggal_mulai'] = date('Y-m-d', strtotime($data['tanggal_mulai']));
		$data['tanggal_selesai'] = date('Y-m-d', strtotime($data['tanggal_selesai']));

		$result = Kegiatan_konsultan::find($id)->update($data);
		if ($result) {
			return $result;
		}

		return false;
	}

	// Delete
	public function delete($id) {
		$result = Kegiatan_konsultan::destroy($id);
		if ($result) {
			return true;
		}
		return false;
	}

	public function jmlPesertaKegiatan() {
		$jumlah_peserta = array();
		$result = Kegiatan_konsultan::all();
		foreach ($result as $row) {
			$jumlah_peserta[] = $row->jumlah_peserta;
		}

		return array_sum($jumlah_peserta);
	}

	public function jmlPesertaKegiatanPerTahun() {
		$kegiatan = DB::table('kegiatan_konsultans')
			->select(DB::raw("SUM(jumlah_peserta) as count, DATE_FORMAT(tanggal_mulai, '%Y') as the_year"))
			->groupBy('the_year');
		return $kegiatan;
	}
}