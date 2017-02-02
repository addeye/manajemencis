<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 02/02/2017
 * Time: 16:29
 */

namespace App\Repositories;


use App\Pendidikans;

class PendidikanRepository
{
    // Select All
    Public function getAll()
    {
        return Pendidikans::all();
    }

    // Select where id
    public function getById($id)
    {
        return Pendidikans::find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = Pendidikans::create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =Pendidikans::find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = Pendidikans::destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }
}