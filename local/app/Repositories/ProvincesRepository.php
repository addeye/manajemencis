<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 26/01/2017
 * Time: 18:59
 */

namespace App\Repositories;


use App\Provinces;

class ProvincesRepository
{
    public function getAll()
    {
        return Provinces::all();
    }

    public function getById($id)
    {
        return Provinces::find($id);
    }

    

    public function create($data=array())
    {
        $result = Provinces::create($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function update($id,$data=array())
    {
        $result = Provinces::find($id)->update($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $result = Provinces::destroy($id);
        if($result)
        {
            return true;
        }
        return false;
    }
}