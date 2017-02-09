<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 07/02/2017
 * Time: 13:40
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\LembagaRepository;
use App\Repositories\ProvincesRepository;

class LembagaController extends Controller
{
    protected $lembaga;
    protected $provinces;

    public function __construct(LembagaRepository $lembaga, ProvincesRepository $provinces)
    {
        $this->lembaga = $lembaga;
        $this->provinces = $provinces;
    }
}