<?php

/**
 * Created by Sublime.
 * User: Dio Putra
 * Date: 29/01/2017
 * Time: 22:54
 */

namespace App\Repositories;

use App\Bidang_layanan ;

class BidangLayananRepository
{

	// Select All
	Public function getAll()
	{
		return Bidang_layanan::all();
	}

	// Select where id
	public function getById($id)
	{
		return Bidang_layanan::find($id);
	}

	// Insert into
	public function create($data=array())
	{
		$result = Bidang_layanan::create($data);
		if ($result)
		{
			return true;
		}

		return false;
	}


	// Update
	public function update($id,$data=array())
	{
		$result =Bidang_layanan::find($id)->update($data);
		if ($result)
		{
			return true;
		}

		return false;
	}

	// Delete
	public function delete($id)
	{
		$result = Bidang_layanan::destroy($id);
		if ($result)
		{
			return true;
		}
		return false;
	}

}
