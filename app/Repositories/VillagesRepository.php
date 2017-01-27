<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 28/01/2017
 * Time: 1:52
 */

namespace App\Repositories;


use App\Villages;

class VillagesRepository
{
    public function getAll()
    {
        return Villages::all();
    }

    public function getById($id)
    {
        return Villages::find($id);
    }

    public function create($data=array())
    {
        $result = Villages::create($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function update($id,$data=array())
    {
        $result = Villages::find($id)->update($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $result = Villages::destroy($id);
        if($result)
        {
            return true;
        }
        return false;
    }
}