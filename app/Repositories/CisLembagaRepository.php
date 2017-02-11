<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 10/02/2017
 * Time: 15:00
 */

namespace App\Repositories;


use App\Cis_lembaga;

class CisLembagaRepository
{
    protected $cislembaga;

    public function __construct(Cis_lembaga $cis_lembaga)
    {
        $this->cislembaga = $cis_lembaga;
    }

    public function getAll()
    {
        return $this->cislembaga->all();
    }

    public function getById($id)
    {
        return $this->cislembaga->find($id);
    }

    public function create($data=array())
    {
        $result = $this->cislembaga->create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    public function update($id,$data=array())
    {
        $result = $this->cislembaga->find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->cislembaga->destroy($id);
        if ($result)
        {
            return true;
        }

        return false;

    }
}