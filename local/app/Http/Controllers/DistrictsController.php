<?php

namespace App\Http\Controllers;

use App\Repositories\DistrictsRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use App\Repositories\VillagesRepository;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    protected $districts;
    protected $provinces;
    protected $regencies;
    protected $villages;

    public function __construct(DistrictsRepository $districts, ProvincesRepository $provinces, RegenciesRepository $regencies, VillagesRepository $villages)
    {
        $this->districts = $districts;
        $this->provinces = $provinces;
        $this->regencies = $regencies;
        $this->villages = $villages;
    }

    public function getAll()
    {
        $data = array(
            'title' => 'Data Kecamatan',
            'districts' => $this->districts->getAll()
        );
        return view('districts.list_districts',$data);
    }

    public function addData()
    {
        $data = Array
        (
            'title' => 'Tambah Data Kecamatan',
            'provinces' => $this->provinces->getAll(),
        );
        return view('districts.add_districts',$data);
    }

    public function getVillagesByDistricts($districts_id)
    {
        $data = array(
            'title' => 'Data Kelurahan',
            'district_id' => $districts_id,
            'villages' => $this->villages->getByDistrict($districts_id)
        );
        return view('districts.list_villages',$data);
    }

    public function doAddData(Request $request)
    {
        $data = array(
            'id' => $request->id,
            'regency_id' => $request->regency_id,
            'name' => $request->name
        );
        $result = $this->districts->create($data);
        if($result)
        {
            return redirect('districts')->with('success','Data Kabupaten/Kota Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = array(
            'title' => 'Edit Kabupaten/Kota',
            'data' => $this->districts->getById($id),
            'provinces' => $this->provinces->getAll(),
        );
        return view('districts.edit_districts',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = array(
            'id' => $request->id,
            'province_id' => $request->province_id,
            'name' => $request->name
        );
        $result = $this->districts->update($id,$data);
        if($result)
        {
            return redirect('districts')->with('info','Data Kabupaten/Kota Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->districts->delete($id);
        if($result)
        {
            return redirect('districts')->with('info','Data Kabupaten/Kota Berhasil Dihapus');
        }
    }
}
