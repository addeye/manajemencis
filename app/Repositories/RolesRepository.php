<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 02/02/2017
 * Time: 11:40
 */

namespace App\Repositories;


use App\Roles;

class RolesRepository
{
    // Select All
    Public function getAll()
    {
        return Roles::all();
    }

    // Select where id
    public function getById($id)
    {
        return Roles::find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = Roles::create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =Roles::find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = Roles::destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }
}