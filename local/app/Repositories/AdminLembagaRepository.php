<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 07/02/2017
 * Time: 14:55
 */

namespace App\Repositories;


use App\Admin_lembaga;
use App\User;

class AdminLembagaRepository
{
    Public function getAll()
    {
        return Admin_lembaga::all();
    }

    // Select where id
    public function getById($id)
    {
        return Admin_lembaga::find($id);
    }

    // Insert into
    public function create($data=array())
    {
        if(!isset($data['path']))
        {
            $path='default.png';
        }
        else
        {
            $path = $data['path'];
        }
        $dataUser = array(
            'name' => $data['nama_lengkap'],
            'role_id' => 2,
            'email' => $data['email'],
            'path' => $path,
            'password' => bcrypt($data['password'])
        );

        $users = User::create($dataUser);
        $data['user_id'] = $users->id;

        $result = Admin_lembaga::create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result = Admin_lembaga::find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $data = Admin_lembaga::find($id);
        $user_id = $data->user_id;
        $result = Admin_lembaga::destroy($id);
        if ($result)
        {
            User::destroy($user_id);
            return true;
        }
        return false;
    }

    public function updateByUser($user_id,$data=array())
    {
        $result = Admin_lembaga::where('user_id',$user_id)->update($data);
        if($result)
        {
            return true;
        }
        return false;
    }
}