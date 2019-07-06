<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 13/03/2017
 * Time: 12:42
 */

namespace App\Repositories;


use App\InformasiPasar;

class InformasiPasarRepository
{
    protected $informasi_pasar;

    public function __construct(InformasiPasar $informasiPasar)
    {
        $this->informasi_pasar = $informasiPasar;
    }
    // Select All
    Public function getAll()
    {
        return $this->informasi_pasar->orderBy('id','desc')->get();
    }

    // Select where id
    public function getById($id)
    {
        return $this->informasi_pasar->find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = $this->informasi_pasar->create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =$this->informasi_pasar->find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = $this->informasi_pasar->destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }
}