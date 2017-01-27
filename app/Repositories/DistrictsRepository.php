<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 28/01/2017
 * Time: 1:22
 */

namespace App\Repositories;


use App\Districts;

class DistrictsRepository
{
    public function getAll()
    {
        return Districts::all();
    }

    public function getById($id)
    {
        return Districts::find($id);
    }

    public function create($data=array())
    {
        $result = Districts::create($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function update($id,$data=array())
    {
        $result = Districts::find($id)->update($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $result = Districts::destroy($id);
        if($result)
        {
            return true;
        }
        return false;
    }
}