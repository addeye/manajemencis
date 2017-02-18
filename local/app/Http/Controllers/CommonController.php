<?php

namespace App\Http\Controllers;

use App\Repositories\DetailsProkersRepository;
use App\Repositories\DistrictsRepository;
use App\Repositories\ProkerKonsultanRepository;
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
    protected $dproker;

    public function __construct(ProvincesRepository $provinces,
                                RegenciesRepository $regencies,
                                DistrictsRepository $districts,
                                VillagesRepository $villages, DetailsProkersRepository $dproker)
    {
        $this->provinces = $provinces;
        $this->regencies = $regencies;
        $this->districts = $districts;
        $this->villages = $villages;
        $this->dproker = $dproker;
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

    public function getDetailProker($id)
    {
        $data['detail'] = $this->dproker->getAllByProker($id);
        return view('common.detail_proker',$data);
    }

    public function getDetailKegiatan($id)
    {
        $data['data'] = $this->dproker->getById($id);
        return view('common.detail_kegiatan',$data);
    }
}
