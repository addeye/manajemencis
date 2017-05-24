<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 09/03/2017
 * Time: 15:51
 */

namespace App\Repositories;


use App\Konsultasi;

class KonsultasiRepository
{
    protected $konsultasi;

    public function __construct(Konsultasi $konsultasi)
    {
        $this->konsultasi = $konsultasi;
    }

    // Select All
    Public function getAll()
    {
        return $this->konsultasi->orderBy('id','desc')->take(10)->get();
    }

    // Select where id
    public function getById($id)
    {
        return $this->konsultasi->find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = $this->konsultasi->create($data);
        if ($result)
        {
            return $result;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =$this->konsultasi->find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = $this->konsultasi->destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }
}