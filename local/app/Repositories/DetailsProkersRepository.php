<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 04/02/2017
 * Time: 1:58
 */

namespace App\Repositories;


use App\Details_proker;

class DetailsProkersRepository
{
    // Select All
    Public function getAll()
    {
        return Details_proker::all();
    }

    public function getAllByProker($idproker)
    {
        return Details_proker::where('proker_id',$idproker)->get();
    }

    // Select where id
    public function getById($id)
    {
        return Details_proker::find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = Details_proker::create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =Details_proker::find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = Details_proker::destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }

    public function jmlPenerimaManfaat()
    {
        $jml_penerima = array();
        $result = Details_proker::all();
        foreach($result as $row)
        {
            $jml_penerima[] = $row->jml_penerima;
        }

        return array_sum($jml_penerima);
    }
}