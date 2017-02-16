<?php

namespace App\Http\Controllers\Konsultan;

use App\Http\Controllers\Controller;
use App\Repositories\DetailsProkersRepository;
use App\Repositories\JenisLayananRepository;
use App\Repositories\ProkerKonsultanRepository;
use Illuminate\Http\Request;

class DetailsProkerController extends Controller
{
    protected $detailproker;
    protected $proker;
    protected $jenislayanan;

    public function __construct(DetailsProkersRepository $detailproker, ProkerKonsultanRepository $proker, JenisLayananRepository $jenislayanan)
    {
        $this->detailproker = $detailproker;
        $this->proker = $proker;
        $this->jenislayanan = $jenislayanan;
    }

    public function getAll($idproker)
    {
        $proker = $this->proker->getById($idproker);
        $data = Array
        (
            'head_title' => 'Detail Program Kerja '.$proker->tahun_kegiatan.' '.$proker->program,
            'title' => 'Detail Program Kerja',
            'data' => $this->detailproker->getAllByProker($idproker),
            'proker' => $proker
        );
        return view('dashboard.konsultan.dproker.list',$data);
    }

    public function addData($idproker)
    {
        $data = Array
        (
            'title' => 'Tambah Detail Program Kerja',
            'proker' => $this->proker->getById($idproker),
            'jenis_layanan' => $this->jenislayanan->getByBidangLayanan()
        );
        return view('dashboard.konsultan.dproker.add',$data);
    }

    public function doAddData(Request $request)
    {
        $data = $request->all();
//        return $data;
        $result = $this->detailproker->create($data);
        if($result)
        {
            return redirect('k/dproker/'.$request->proker_id)->with('success','Data Detail Program Kerja Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = array(
            'title' => 'Edit Program Kerja',
            'data' => $this->detailproker->getById($id),
            'jenis_layanan' => $this->jenislayanan->getByBidangLayanan()
        );
        return view('dashboard.konsultan.dproker.edit',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = $request->all();
//        return $data;
        $result = $this->detailproker->update($id,$data);
        if($result)
        {
            return redirect('k/dproker/'.$request->proker_id)->with('info','Data Program Kerja Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $data = $this->detailproker->getById($id);
        $result = $this->detailproker->delete($id);
        if($result)
        {
            return redirect('k/dproker/'.$data->proker_id)->with('info','Data Bidang Layanan Berhasil Dihapus');
        }
    }
}
