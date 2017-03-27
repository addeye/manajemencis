<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 02/02/2017
 * Time: 13:32
 */

namespace App\Repositories;


use App\Konsultan;
use App\Konsultasi;
use App\User;

class KonsultanRepository
{
    // Select All
    Public function getAll()
    {
        return Konsultan::orderBy('created_at','desc')->get();
    }

    // Select where id
    public function getById($id)
    {
        return Konsultan::find($id);
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
            'role_id' => 3,
            'email' => $data['email'],
            'path' => $path,
            'password' => bcrypt($data['password'])
        );

        $tgl_sementara = $data['tanggal_lahir'];
        $date = str_replace('/', '-', $tgl_sementara);
        $final_date = date('Y-m-d', strtotime($date));
        $data['tanggal_lahir'] = date('Y-m-d', strtotime($final_date));

        $users = User::create($dataUser);
        $data['user_id'] = $users->id;

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
        $dataUser = array(
            'name' => $data['nama_lengkap'],
            'email' => $data['email'],
        );

        $tgl_sementara = $data['tanggal_lahir'];
        $date = str_replace('/', '-', $tgl_sementara);
        $final_date = date('Y-m-d', strtotime($date));
        $data['tanggal_lahir'] = date('Y-m-d', strtotime($final_date));

        User::find($data['user_id'])->update($dataUser);
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
        $konsultan = Konsultan::find($id);
        $user_id = $konsultan->user_id;
        $result = Konsultan::destroy($id);
        if ($result)
        {
            User::destroy($user_id);
            return true;
        }
        return false;
    }

    public function getByUserId($id)
    {
        $result = Konsultan::with('lembagas')->where('user_id',$id)->first();
        if($result)
        {
            return $result;
        }
        return false;
    }

    public function updateByUser($user_id,$data=array())
    {
        $result = Konsultan::where('user_id',$user_id)->update($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function getByLembagaId($lembaga_id)
    {
        return Konsultan::where('lembaga_id',$lembaga_id)->get();
    }
}