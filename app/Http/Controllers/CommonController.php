<?php

namespace App\Http\Controllers;

use App\Repositories\DistrictsRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use App\Repositories\VillagesRepository;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    protected $provinces;
    protected $regencies;
    protected $districts;
    protected $villages;

    public function __construct(ProvincesRepository $provinces, RegenciesRepository $regencies, DistrictsRepository $districts, VillagesRepository $villages)
    {
        $this->provinces = $provinces;
        $this->regencies = $regencies;
        $this->districts = $districts;
        $this->villages = $villages;
    }

    public function getRegencies($provinces_id)
    {
        $data['regencies'] = $this->regencies->getByProvinces($provinces_id);
        return view('common.regencies',$data);
    }

    public function getDistricts($regencies_id)
    {
        $data['districts'] = $this->districts->getByRegencies($regencies_id);
        return view('common.districts',$data);
    }

    public function getVillages($districts_id)
    {
        $data['villages'] = $this->villages->getByDistrict($districts_id);
        return view('common.villages',$data);
    }
}
