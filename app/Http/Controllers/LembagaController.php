<?php

namespace App\Http\Controllers;

use App\Provinces;
use App\Repositories\LembagaRepository;
use App\Repositories\ProvincesRepository;
use App\Tingkats;
use Illuminate\Http\Request;

class LembagaController extends Controller
{
    protected $lembaga;
    protected $provinces;

    public function __construct(LembagaRepository $lembaga, ProvincesRepository $provinces)
    {
        $this->lembaga = $lembaga;
        $this->provinces = $provinces;
    }

    public function getAll()
    {
        $data = array(
            'title' => 'Data Provinsi',
            'lembaga' => $this->lembaga->getAll()
        );
        return view('lembaga.list_lembaga',$data);
    }

    public function addData()
    {
        $data = Array
        (
            'title' => 'Tambah Data Lembaga',
            'tingkat' => Tingkats::all(),
            'provinces' => $this->provinces->getAll()

        );
        return view('lembaga.add_lembaga',$data);
    }

    public function doAddData(Request $request)
    {
        $data = $request->all();
        $result = $this->lembaga->create($data);
        if($result)
        {
            return redirect('lembaga')->with('success','Data Bidang Layanan Berhasil Disimpan');
        }
    }

    public function detailData($id)
    {
        $data = Array
        (
            'title' => 'Detail Lembaga',
            'data' => $this->lembaga->getById($id)

        );
        return view('lembaga.detail_lembaga',$data);
    }

    public function editData($id)
    {
        $data = Array
        (
            'title' => 'Edit Data Lembaga',
            'tingkat' => Tingkats::all(),
            'provinces' => $this->provinces->getAll(),
            'data' => $this->lembaga->getById($id)

        );
        return view('lembaga.edit_lembaga',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = $request->all();

        unset($data['_method']);
        unset($data['_token']);

        $result = $this->lembaga->update($id,$data);
        if($result)
        {
            return redirect('lembaga')->with('info','Data Lembaga '.$data['name'].' Sudah Di Update');
        }
    }

    public function deleteData($id)
    {
        $result = $this->lembaga->delete($id);
        if($result)
        {
            return redirect('lembaga')->with('info','Data Lembaga Berhasil Dihapus');
        }
    }
}
