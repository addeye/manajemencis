<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 08/02/2017
 * Time: 11:15
 */

namespace App\Repositories;


use App\Sentra_kumkm;

class SentraKumkmRepository
{
    Public function getAll()
    {
        return Sentra_kumkm::all();
    }

    // Select where id
    public function getById($id)
    {
        return Sentra_kumkm::find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = Sentra_kumkm::create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =Sentra_kumkm::find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $data = Sentra_kumkm::find($id);
        $user_id = $data->user_id;
        $result = Sentra_kumkm::destroy($id);
        if ($result)
        {
            User::destroy($user_id);
            return true;
        }
        return false;
    }
}