<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 01/02/2017
 * Time: 15:34
 */

namespace App\Repositories;


use App\Lembaga;

class LembagaRepository
{
    public function getAll()
    {
        return Lembaga::all();
    }

    public function getById($id)
    {
        return Lembaga::find($id);
    }



    public function create($data=array())
    {
        $result = Lembaga::create($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function update($id,$data=array())
    {
        $result = Lembaga::find($id)->update($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $result = Lembaga::destroy($id);
        if($result)
        {
            return true;
        }
        return false;
    }
}