<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 02/02/2017
 * Time: 12:48
 */

namespace App\Repositories;


use App\Tingkats;

class TingkatsRepository
{
    // Select All
    Public function getAll()
    {
        return Tingkats::all();
    }

    // Select where id
    public function getById($id)
    {
        return Tingkats::find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = Tingkats::create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =Tingkats::find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = Tingkats::destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }
}