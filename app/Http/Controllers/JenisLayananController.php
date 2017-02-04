<?php

namespace App\Http\Controllers;


use App\Repositories\BidangLayananRepository;
use App\Repositories\JenisLayananRepository;
use Illuminate\Http\Request;

class JenisLayananController extends Controller
{
    protected $jenislayanan;
    protected $bidanglayanan;

    public function __construct(JenisLayananRepository $jenislayanan, BidangLayananRepository $bidanglayanan)
    {
    	$this->jenislayanan = $jenislayanan;
        $this->bidanglayanan = $bidanglayanan;
    }

    public function getAll()
    {
    	$data = array
    	(
            'head_title' => 'Data Bidang Jenis Layanan',
    		'title' => 'Data Jenis Layanan',
    		'jenislayanan' => $this->jenislayanan->getAll()

    	);

    	return view('jenis_layanan.list_jenis_layanan' ,$data);
    }

    public function addData()
    {
        $data = Array
        (
            'title' => 'Tambah Jenis Layanan',
            'bidang' => $this->bidanglayanan->getAll()
        );
        return view('jenis_layanan.add_jenis_layanan',$data);
    }

    public function doAddData(Request $request)
    {
        $name =  $request->name;
        foreach($name as $row)
        {
            if($row!='')
            {
                $data = array(
                    'name' => $row,
                    'bidang_layanan_id' => $request->bidang_layanan_id
                );
                $result = $this->jenislayanan->create($data);
            }
        }

        if($result)
        {
            return redirect('jenislayanan')->with('success','Data Jenis Layanan Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = array(
            'title' => 'Edit Jenis Layanan',
            'data' => $this->jenislayanan->getById($id),
            'bidang' => $this->bidanglayanan->getAll()
        );
        return view('jenis_layanan.edit_jenis_layanan',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = array(
            'name'=>$request->name
        );
        $result = $this->jenislayanan->update($id,$data);
        if($result)
        {
            return redirect('jenislayanan')->with('info','Data Jenis Layanan Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->jenislayanan->delete($id);
        if($result)
        {
            return redirect('jenislayanan')->with('info','Data Jenis Layanan Berhasil Dihapus');
        }
    }
}
