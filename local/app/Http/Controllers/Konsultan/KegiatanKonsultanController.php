<?php

namespace App\Http\Controllers\Konsultan;

use App\Http\Controllers\Controller;
use App\Repositories\BidangUsahaRepository;
use App\Repositories\DetailsProkersRepository;
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
    protected $dproker;

    public function __construct(KegiatanKonsultanRepository $kegiatankonsultan,
                                JenisLayananRepository $jenislayanan,
                                BidangUsahaRepository $bidangusaha, ProkerKonsultanRepository $proker, DetailsProkersRepository $detailsProkersRepository)
    {
        $this->kegiatankonsultan = $kegiatankonsultan;
        $this->jenislayanan = $jenislayanan;
        $this->bidangusaha = $bidangusaha;
        $this->proker = $proker;
        $this->dproker = $detailsProkersRepository;
    }

    public function getAll()
    {
        $data = Array
        (
            'head_title' => 'Data Pelaporan Kegiatan Konsultan',
            'title' => 'Kegiatan Konsultan',
            'data' => $this->kegiatankonsultan->getAllByKonsultan()
        );
//        return $data;
        return view('dashboard.konsultan.kegiatan.list',$data);
    }

    public function addData()
    {
        $data = Array
        (
            'title' => 'Tambah Pelaporan Kegiatan Konsultan',
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
        $rowkegiatan = $this->kegiatankonsultan->getById($id);
        $data = array(
            'title' => 'Edit Pelaporan Kegiatan',
            'data' => $rowkegiatan,
            'bidang_usaha' => $this->bidangusaha->getAll(),
            'proker' => $this->proker->getAllByKonsultan(),
            'dproker' => $this->dproker->getById($rowkegiatan->detail_proker_id)
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
