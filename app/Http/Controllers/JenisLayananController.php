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
            'head_title' => 'Indikator Kerja Utama Layanan',
    		'title' => 'IKU Layanan',
    		'jenislayanan' => $this->jenislayanan->getAll()

    	);

    	return view('jenis_layanan.list_jenis_layanan' ,$data);
    }

    public function addData()
    {
        $data = Array
        (
            'title' => 'Tambah IKU Layanan',
            'bidang' => $this->bidanglayanan->getAll()
        );
        return view('jenis_layanan.add_jenis_layanan',$data);
    }

    public function doAddData(Request $request)
    {
        $name =  $request->name;
        $proses_or_output = $request->proses_or_output;
        foreach($name as $key=>$row)
        {
            if($row!='')
            {
                $data = array(
                    'name' => $row,
                    'bidang_layanan_id' => $request->bidang_layanan_id,
                    'proses_or_output' => $proses_or_output[$key]
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
            'title' => 'Edit IKU Layanan',
            'data' => $this->jenislayanan->getById($id),
            'bidang' => $this->bidanglayanan->getAll()
        );
        return view('jenis_layanan.edit_jenis_layanan',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = array(
            'name'=>$request->name,
            'proses_or_output' => $request->proses_or_output
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
