<?php

namespace App\Http\Controllers\Konsultan;

use App\Http\Controllers\Controller;
use App\Repositories\ProkerKonsultanRepository;
use Illuminate\Http\Request;

class ProkerKonsultanController extends Controller
{
    protected $proker;

    public function __construct(ProkerKonsultanRepository $proker)
    {
        $this->proker = $proker;
    }

    public function getAll()
    {
        $data = Array
        (
            'title' => 'Data Program Kerja',
            'data' => $this->proker->getAll()
        );
        return view('dashboard.konsultan.proker.list',$data);
    }

    public function addData()
    {
        $data = Array
        (
            'title' => 'Tambah Program Kerja',

        );
        return view('dashboard.konsultan.proker.add',$data);
    }

    public function doAddData(Request $request)
    {
        $data = $request->all();
        $result = $this->proker->create($data);
        if($result)
        {
            return redirect('k/proker')->with('success','Data Program Kerja Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = array(
            'title' => 'Edit Program Kerja',
            'data' => $this->proker->getById($id)
        );
        return view('dashboard.konsultan.proker.edit',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = $request->all();
        $result = $this->proker->update($id,$data);
        if($result)
        {
            return redirect('k/proker')->with('info','Data Program Kerja Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->proker->delete($id);
        if($result)
        {
            return redirect('k/proker')->with('info','Data Bidang Layanan Berhasil Dihapus');
        }
    }

    public function detailData($id)
    {
        $data = array(
            'title' => 'Detail Program Kerja',
            'data' => $this->proker->getById($id)
        );
        return view('dashboard.konsultan.proker.detail',$data);
    }
}
