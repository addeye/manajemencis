<?php

namespace App\Http\Controllers;

use App\Repositories\BidangLayananRepository;
use App\Repositories\KonsultanRepository;
use App\Repositories\LembagaRepository;
use App\Repositories\PendidikanRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use Illuminate\Http\Request;

class KonsultanController extends Controller
{
    protected $konsultan;
    protected $provinces;
    protected $regencies;
    protected $pendidikan;
    protected $lembaga;
    protected $bidanglayanan;

    public function __construct(KonsultanRepository $konsultan,
                                ProvincesRepository $provinces,
                                RegenciesRepository $regencies,
                                PendidikanRepository $pendidikan,
                                LembagaRepository $lembaga, BidangLayananRepository $bidanglayanan)
    {
        $this->konsultan = $konsultan;
        $this->provinces = $provinces;
        $this->regencies = $regencies;
        $this->pendidikan = $pendidikan;
        $this->lembaga = $lembaga;
        $this->bidanglayanan = $bidanglayanan;
    }

    public function getAll()
    {
        $data = Array
        (
            'title' => 'Data Konsultan',
            'konsultan' => $this->konsultan->getAll()

        );
        return view('konsultan.k_list',$data);
    }

    public function addData()
    {
        $data = Array
        (
            'title' => 'Tambah Konsultan',
            'provinces' => $this->provinces->getAll(),
            'regencies' => $this->regencies->getAll(),
            'pendidikan' => $this->pendidikan->getAll(),
            'lembaga' => $this->lembaga->getAll(),
            'bidanglayanan' => $this->bidanglayanan->getAll()
        );
        return view('konsultan.k_add',$data);
    }

    public function doAddData(Request $request)
    {
        $data = $request->all();
        $result = $this->bidanglayanan->create($data);
        if($result)
        {
            return redirect('bidanglayanan')->with('success','Data Bidang Layanan Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = array(
            'title' => 'Edit Bidang Layanan',
            'data' => $this->bidanglayanan->getById($id)
        );
        return view('bidang_layanan.edit_bidang_layanan',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = array(
            'name'=>$request->name
        );
        $result = $this->bidanglayanan->update($id,$data);
        if($result)
        {
            return redirect('bidanglayanan')->with('info','Data Bidang Layanan Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->bidanglayanan->delete($id);
        if($result)
        {
            return redirect('bidanglayanan')->with('info','Data Bidang Layanan Berhasil Dihapus');
        }
    }
}
