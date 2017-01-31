<?php

/**
 * Created by Sublime.
 * User: Dio Putra
 * Date: 30/01/2017
 * Time: 03:05
 */

namespace App\Repositories;


use App\Bidang_Usaha;

class BidangUsahaRepository
{
	public function getAll()
	{
		return Bidang_Usaha::all();
	}

	public function getById($id)
	{
		return Bidang_Usaha::find($id);
	}

	public function create($data=Array())
	{
		$result = Bidang_Usaha::create($data);
		if ($result)
		{
			return true;
		}

		return false;
	}

	public function update($id,$data=Array())
	{
		$result= Bidang_Usaha::find($id)->update($data);
		if ($result)
		{
			return true;
		}

		return false;
	}

	public function delete($id)
	{
		$result= Bidang_Usaha::destroy($id);
		if ($result)
		{
			return true;
		}
		return false;
		
	}

}