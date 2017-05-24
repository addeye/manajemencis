<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 28/01/2017
 * Time: 0:54
 */

namespace App\Repositories;


use App\Regencies;

class RegenciesRepository
{
    public function getAll()
    {
        return Regencies::with('provinces')->get();
    }

    public function getById($id)
    {
        return Regencies::find($id);
    }

    public function getByProvinces($province_id)
    {
        return Regencies::where('province_id',$province_id)->get();
    }

    public function create($data=array())
    {
        $result = Regencies::create($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function update($id,$data=array())
    {
        $result = Regencies::find($id)->update($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $result = Regencies::destroy($id);
        if($result)
        {
            return true;
        }
        return false;
    }
}