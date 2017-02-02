<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 02/02/2017
 * Time: 11:22
 */

namespace App\Repositories;


use App\User;

class UserRepository
{
    public function getAll()
    {
        return User::all();
    }

    public function getById($id)
    {
        return User::find($id);
    }



    public function create($data=array())
    {
        $result = User::create($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function update($id,$data=array())
    {
        $result = User::find($id)->update($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $result = User::destroy($id);
        if($result)
        {
            return true;
        }
        return false;
    }

}