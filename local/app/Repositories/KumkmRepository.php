<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 18/03/2017
 * Time: 13:56
 */

namespace App\Repositories;


use App\Kumkm;

class KumkmRepository
{
    protected $kumkm;

    public function __construct(Kumkm $kumkm)
    {
        $this->kumkm = $kumkm;
    }
    // Select All
    Public function getAll()
    {
        return $this->kumkm->all();
    }

    // Select where id
    public function getById($id)
    {
        return $this->kumkm->find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = $this->kumkm->create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =$this->kumkm->find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = $this->kumkm->destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }
}