<?php

namespace App\Http\Controllers\Konsultan;

use App\Http\Controllers\Controller;
use App\Repositories\BidangUsahaRepository;
use App\Repositories\JenisLayananRepository;
use App\Repositories\KegiatanKonsultanRepository;
use App\Repositories\ProkerKonsultanRepository;
use Illuminate\Http\Request;

class KegiatanKonsultanController extends Controller
{
    protected $kegiatankonsultan;
    protected $jenislayanan;
    protected $bidangusaha;
    protected $proker;

    public function __construct(KegiatanKonsultanRepository $kegiatankonsultan,
                                JenisLayananRepository $jenislayanan,
                                BidangUsahaRepository $bidangusaha, ProkerKonsultanRepository $proker)
    {
        $this->kegiatankonsultan = $kegiatankonsultan;
        $this->jenislayanan = $jenislayanan;
        $this->bidangusaha = $bidangusaha;
        $this->proker = $proker;
    }

    public function getAll()
    {
        $data = Array
        (
            'head_title' => 'Data Kegiatan Konsultan',
            'title' => 'Kegiatan Konsultan',
            'data' => $this->kegiatankonsultan->getAll()
        );
//        return $data;
        return view('dashboard.konsultan.kegiatan.list',$data);
    }

    public function addData()
    {
        $data = Array
        (
            'title' => 'Tambah Kegiatan Konsultan',
            'jenis_layanan' => $this->jenislayanan->getByBidangLayanan(),
            'bidang_usaha' => $this->bidangusaha->getAll(),
            'proker' => $this->proker->getAllByKonsultan()

        );
        return view('dashboard.konsultan.kegiatan.add',$data);
    }

    public function doAddData(Request $request)
    {
        $data = $request->all();
        $result = $this->kegiatankonsultan->create($data);
        if($result)
        {
            return redirect('k/kegiatan')->with('success','Data Kegiatan Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = array(
            'title' => 'Edit Kegiatan',
            'data' => $this->kegiatankonsultan->getById($id),
            'jenis_layanan' => $this->jenislayanan->getByBidangLayanan(),
            'bidang_usaha' => $this->bidangusaha->getAll()
        );
        return view('dashboard.konsultan.kegiatan.edit',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = $request->all();
        $result = $this->kegiatankonsultan->update($id,$data);
        if($result)
        {
            return redirect('k/kegiatan')->with('info','Data Kegiatan Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->kegiatankonsultan->delete($id);
        if($result)
        {
            return redirect('k/kegiatan')->with('info','Data Kegiatan Berhasil Dihapus');
        }
    }
}
