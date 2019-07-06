<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 10/02/2017
 * Time: 15:06
 */

namespace App\Repositories;


use App\Cis_filemanager;

class CisFilemanagerRepository
{
    protected $cisfilemanager;

    public function __construct(Cis_filemanager $cis_filemanager)
    {
        $this->cisfilemanager = $cis_filemanager;
    }

    public function getAll()
    {
        return $this->cisfilemanager->all();
    }

    public function getById($id)
    {
        return $this->cisfilemanager->find($id);
    }

    public function create($data=array())
    {
        $result = $this->cisfilemanager->create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    public function update($id,$data=array())
    {
        $result = $this->cisfilemanager->find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->cisfilemanager->destroy($id);
        if ($result)
        {
            return true;
        }

        return false;

    }
}