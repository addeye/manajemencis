<?php

namespace App\Http\Controllers;

use App\Repositories\BidangUsahaRepository;
use Illuminate\Http\Request;

class BidangUsahaController extends Controller
{
    protected $bidangusaha;

    public function __construct(BidangUsahaRepository $bidangusaha)
    {
        $this->bidangusaha = $bidangusaha;
    }

    public function getAll()
    {
        $data = Array
        (
            'title' => 'Data Bidang Usaha',
            'bidangusaha' => $this->bidangusaha->getAll()

        );
        return view('bidang_usaha.list_bidang_usaha',$data);
    }

    public function addData()
    {
        $data = Array
        (
            'title' => 'Tambah Bidang Usaha',

        );
        return view('bidang_usaha.add_bidang_usaha',$data);
    }

    public function doAddData(Request $request)
    {
        $data = array(
            'name' => $request->name
        );
        $result = $this->bidangusaha->create($data);
        if($result)
        {
            return redirect('bidangusaha')->with('success','Data Bidang Usaha Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = array(
            'title' => 'Edit Bidang Usaha',
            'data' => $this->bidangusaha->getById($id)
        );
        return view('bidang_usaha.edit_bidang_usaha',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = array(
            'name'=>$request->name
        );
        $result = $this->bidangusaha->update($id,$data);
        if($result)
        {
            return redirect('bidangusaha')->with('info','Data Bidang Usaha Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->bidangusaha->delete($id);
        if($result)
        {
            return redirect('bidangusaha')->with('info','Data Bidang Usaha Berhasil Dihapus');
        }
    }
}
