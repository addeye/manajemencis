<?php

namespace App\Http\Controllers;


use App\Repositories\BidangLayananRepository;
use Illuminate\Http\Request;

class BidangLayananController extends Controller
{
    protected $bidanglayanan;

    public function __construct(BidangLayananRepository $bidanglayanan)
    {
    	$this->bidanglayanan = $bidanglayanan;
    }

    public function getAll()
    {
    	$data = Array
    	(
            'head_title' => 'Data Bidang Layanan',
    		'title' => 'Data Bidang Layanan',
    		'bidanglayanan' => $this->bidanglayanan->getAll()

    	);
    	return view('bidang_layanan.list_bidang_layanan',$data);
    }

    public function addData()
    {
        $data = Array
        (
            'title' => 'Tambah Bidang Layanan',

        );
        return view('bidang_layanan.add_bidang_layanan',$data);
    }

    public function doAddData(Request $request)
    {
        $data = array(
            'name' => $request->name
        );
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
