<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 02/02/2017
 * Time: 13:32
 */

namespace App\Repositories;


use App\Konsultan;

class KonsultanRepository
{
    // Select All
    Public function getAll()
    {
        return Konsultan::all();
    }

    // Select where id
    public function getById($id)
    {
        return Konsultan::find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = Konsultan::create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =Konsultan::find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = Konsultan::destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }
}