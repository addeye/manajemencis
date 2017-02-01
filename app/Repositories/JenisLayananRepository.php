<?php

/**
 * Created by Sublime.
 * User: Dio Putra
 * Date: 29/01/2017
 * Time: 00:54
 */

namespace App\Repositories;

use App\Jenis_layanan;


class JenisLayananRepository
{

	// Select all
	public function getAll()
	{
		return Jenis_layanan::with('bidang_layanan')->get();
	}

	// Select Where id
	public function getById($id)
	{
		return Jenis_layanan::find($id);
	}

	public function create($data=array())
	{
		$result = Jenis_layanan::create($data);
		if ($result)
		{
			return true;
		}
		return flase;
	}

	public function update($id,$data=array())
	{
		$result = Jenis_layanan::find($id)->update($data);
		if ($result)
		{
			return true;
		}

		return flase;
	}

	public function delete($id)
	{
		$result= Jenis_layanan::destroy($id);
		if ($result) {
			return true;
		}

		return false;
	}


}