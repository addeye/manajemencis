<?php

namespace App\Http\Controllers;

use App\Repositories\RegenciesRepository;
use Illuminate\Http\Request;

class RegenciesController extends Controller
{
    protected $regencies;

    public function __construct(RegenciesRepository $regencies)
    {
        $this->regencies = $regencies;
    }

    public function getAll()
    {
        $data = array(
            'title' => 'Data Kabupaten Kota',
            'regencies' => $this->regencies->getAll()
        );
        return view('regencies.list_regencies',$data);
    }

    public function getByProvinces($province_id)
    {
        $data = array(
            'title' => 'Data Kabupaten Kota',
            'regencies' => $this->regencies->getByProvinces($province_id)
        );
        return view('regencies.list_regencies',$data);
    }
}
