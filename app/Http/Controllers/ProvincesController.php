<?php

namespace App\Http\Controllers;

use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use Illuminate\Http\Request;

class ProvincesController extends Controller
{
    protected $provinces;
    protected $regencies;

    public function __construct(ProvincesRepository $provinces, RegenciesRepository $regencies)
    {
        $this->provinces = $provinces;
        $this->regencies = $regencies;
    }

    public function getAll()
    {
        $data = array(
            'title' => 'Data Provinsi',
            'provinces' => $this->provinces->getAll()
        );
        return view('provinces.list_provinces',$data);
    }

    public function getRegenciesByProvinces($province_id)
    {
        $data = array(
            'title' => 'Data Kabupaten Kota',
            'regencies' => $this->regencies->getByProvinces($province_id)
        );
        return view('regencies.list_regencies',$data);
    }
}
