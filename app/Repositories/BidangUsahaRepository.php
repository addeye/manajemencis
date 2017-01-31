<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 31/01/2017
 * Time: 2:04
>>>>>>> 0229f4612d4afda82c3e1724617610da2b9a2a16
 */

namespace App\Repositories;

use App\Bidang_usaha;

class BidangUsahaRepository
{
    // Select All
    Public function getAll()
    {
        return Bidang_usaha::all();
    }

    // Select where id
    public function getById($id)
    {
        return Bidang_usaha::find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = Bidang_usaha::create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result = Bidang_usaha::find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = Bidang_usaha::destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }
}