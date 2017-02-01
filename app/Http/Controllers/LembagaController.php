<?php

namespace App\Http\Controllers;

use App\Repositories\LembagaRepository;
use Illuminate\Http\Request;

class LembagaController extends Controller
{
    protected $lembaga;

    public function __construct(LembagaRepository $lembaga)
    {
        $this->lembaga = $lembaga;
    }

    public function getAll()
    {
        $data = array(
            'title' => 'Data Provinsi',
//            'lembaga' => $this->lembaga->getAll()
        );
        return view('lembaga.list_lembaga',$data);
    }

    public function getRegenciesByProvinces($province_id)
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
            'title' => 'Tambah Data Provinsi',

        );
        return view('provinces.add_provinces',$data);
    }

    public function doAddData(Request $request)
    {
        $data = array(
            'id' => $request->id,
            'name' => $request->name
        );
        $result = $this->provinces->create($data);
        if($result)
        {
            return redirect('provinces')->with('success','Data Bidang Layanan Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = array(
            'title' => 'Edit Provinsi',
            'data' => $this->provinces->getById($id)
        );
        return view('provinces.edit_provinces',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = array(
            'id'=>$request->id,
            'name'=>$request->name,
        );
        $result = $this->provinces->update($id,$data);
        if($result)
        {
            return redirect('provinces')->with('info','Data Bidang Layanan Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->provinces->delete($id);
        if($result)
        {
            return redirect('provinces')->with('info','Data Bidang Layanan Berhasil Dihapus');
        }
    }
}
