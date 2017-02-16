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
        $data['password'] = bcrypt($data['password']);
        $result = User::create($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function update($id,$data=array())
    {
        if($data['password']=='')
        {
            unset($data['password']);
            unset($data['confirm_password']);
        }
        else
        {
            $data['password'] = bcrypt($data['password']);
        }
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