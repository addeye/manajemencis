<?php

namespace App\Http\Controllers;

use App\Repositories\DistrictsRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use Illuminate\Http\Request;

class RegenciesController extends Controller
{
    protected $regencies;
    protected $provinces;
    protected $districts;

    public function __construct(RegenciesRepository $regencies, ProvincesRepository $provinces, DistrictsRepository $districts)
    {
        $this->regencies = $regencies;
        $this->provinces = $provinces;
        $this->districts = $districts;
    }

    public function getAll()
    {
        $data = array(
            'head_title' => 'Master Data Kabupaten Kota',
            'title' => 'Data Kabupaten Kota',
            'regencies' => $this->regencies->getAll()
        );
        return view('regencies.list_regencies',$data);
    }

    public function getDistrictsByRegencies($id)
    {
        $data = array(
            'title' => 'Data Kecamatan',
            'districts' => $this->districts->getByRegencies($id)
        );
        return view('districts.list_districts',$data);
    }

    public function getByProvinces($province_id)
    {
        $data = array(
            'title' => 'Data Kabupaten Kota',
            'regencies' => $this->regencies->getByProvinces($province_id)
        );
        return view('regencies.list_regencies',$data);
    }

    public function addData()
    {
        $data = Array
        (
            'title' => 'Tambah Data Kabupaten/Kota',
            'provinces' => $this->provinces->getAll(),

        );
        return view('regencies.add_regencies',$data);
    }

    public function doAddData(Request $request)
    {
        $data = array(
            'id' => $request->id,
            'province_id' => $request->province_id,
            'name' => $request->name
        );
        $result = $this->regencies->create($data);
        if($result)
        {
            return redirect('regencies')->with('success','Data Kabupaten/Kota Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = array(
            'title' => 'Edit Kabupaten/Kota',
            'data' => $this->regencies->getById($id),
            'provinces' => $this->provinces->getAll(),
        );
        return view('regencies.edit_regencies',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = array(
            'id' => $request->id,
            'province_id' => $request->province_id,
            'name' => $request->name
        );
        $result = $this->regencies->update($id,$data);
        if($result)
        {
            return redirect('regencies')->with('info','Data Kabupaten/Kota Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->regencies->delete($id);
        if($result)
        {
            return redirect('regencies')->with('info','Data Kabupaten/Kota Berhasil Dihapus');
        }
    }
}
