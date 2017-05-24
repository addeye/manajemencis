<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 10/02/2017
 * Time: 15:08
 */

namespace App\Repositories;


use App\Sentra_binaan;

class SentraBinaanRepository
{
    protected $sentrabinaan;

    public function __construct(Sentra_binaan $sentra_binaan)
    {
        $this->sentrabinaan = $sentra_binaan;
    }

    public function getAll()
    {
        return $this->sentrabinaan->all();
    }

    public function getById($id)
    {
        return $this->sentrabinaan->find($id);
    }

    public function create($data=array())
    {
        $result = $this->sentrabinaan->create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    public function update($id,$data=array())
    {
        $result = $this->sentrabinaan->find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->sentrabinaan->destroy($id);
        if ($result)
        {
            return true;
        }

        return false;

    }
}