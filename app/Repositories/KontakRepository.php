<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 07/03/2017
 * Time: 12:12
 */

namespace App\Repositories;


use App\Kontak;

class KontakRepository
{
    protected $kontak;

    public function __construct(Kontak $kontak)
    {
        $this->kontak = $kontak;
    }

    // Select All
    Public function getAll()
    {
        return $this->kontak->all();
    }

    // Select where id
    public function getById($id)
    {
        return $this->kontak->find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = $this->kontak->create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =$this->kontak->find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = $this->kontak->destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }

}