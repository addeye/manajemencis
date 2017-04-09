<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 09/04/2017
 * Time: 19:15
 */

namespace App\Repositories;


use App\Pendampingan;

class PendampinganRepository
{
    protected $pendampingan;

    public function __construct(Pendampingan $pendampingan)
    {
        $this->pendampingan = $pendampingan;
    }

    // Select All
    Public function getAll()
    {
        return $this->pendampingan->all();
    }

    // Select where id
    public function getById($id)
    {
        return $this->pendampingan->find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = $this->pendampingan->create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =$this->pendampingan->find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = $this->pendampingan->destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }
}