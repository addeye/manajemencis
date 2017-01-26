<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 26/01/2017
 * Time: 18:59
 */

namespace App\Repositories;


use App\Provinces;

class ProvincesRepository
{
    public function getAll()
    {
        return Provinces::all();
    }

    public function getById($id)
    {
        return Provinces::find($id);
    }
}