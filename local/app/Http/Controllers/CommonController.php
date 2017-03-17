<?php

namespace App\Http\Controllers;

use App\Cis_lembaga;
use App\Jenis_layanan;
use App\Repositories\BidangLayananRepository;
use App\Repositories\CisLembagaRepository;
use App\Repositories\DetailsProkersRepository;
use App\Repositories\DistrictsRepository;
use App\Repositories\KegiatanKonsultanRepository;
use App\Repositories\ProkerKonsultanRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use App\Repositories\SentraKumkmRepository;
use App\Repositories\VillagesRepository;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    protected $provinces;
    protected $regencies;
    protected $districts;
    protected $villages;
    protected $dproker;
    protected $sentra;
    protected $cis;
    protected $bidanglayanan;
    protected $kegiatan;

    public function __construct(ProvincesRepository $provinces,
                                RegenciesRepository $regencies,
                                DistrictsRepository $districts,
                                VillagesRepository $villages,
                                DetailsProkersRepository $dproker,
                                Jenis_layanan $jenis_layanan,
                                SentraKumkmRepository $sentraKumkmRepository,
                                CisLembagaRepository $cisLembagaRepository,
                                BidangLayananRepository $bidangLayananRepository,
                                KegiatanKonsultanRepository $kegiatanKonsultanRepository)
    {
        $this->provinces = $provinces;
        $this->regencies = $regencies;
        $this->districts = $districts;
        $this->villages = $villages;
        $this->dproker = $dproker;
        $this->jenis_layanan = $jenis_layanan;
        $this->sentra = $sentraKumkmRepository;
        $this->cis = $cisLembagaRepository;
        $this->bidanglayanan = $bidangLayananRepository;
        $this->kegiatan = $kegiatanKonsultanRepository;
    }

    public function getRegencies($provinces_id)
    {
        $data['regencies'] = $this->regencies->getByProvinces($provinces_id);
        return view('common.regencies',$data);
    }

    public function getDistricts($regencies_id)
    {
        $data['districts'] = $this->districts->getByRegencies($regencies_id);
        return view('common.districts',$data);
    }

    public function getVillages($districts_id)
    {
        $data['villages'] = $this->villages->getByDistrict($districts_id);
        return view('common.villages',$data);
    }

    public function getDetailProker($id)
    {
        $data['detail'] = $this->dproker->getAllByProker($id);
        return view('common.detail_proker',$data);
    }

    public function getDetailKegiatan($id)
    {
        $data['data'] = $this->dproker->getById($id);
        return view('common.detail_kegiatan',$data);
    }

    public function getProsesOutput($jenis_layanan_id)
    {
        $rowData = $this->jenis_layanan->find($jenis_layanan_id);
        $data['type'] = $rowData->proses_or_output=='proses'?'text':'number';
        $data['placeholder'] = $rowData->proses_or_output=='proses'?'Angka/Teks':'Angka';
        $data['kategori_iku'] = $rowData->proses_or_output;

        return view('common.form_output_proses',$data);
    }

    public function getSentra()
    {
        $data = array(
            'title' => 'Data Sentra UMKM',
            'sentra' => $this->sentra->getAll()
        );

        return view('common.sentra_umkm',$data);
    }

    public function getProduk()
    {

    }

    public function getKegiatan()
    {
        $cis = $this->cis->getAll();
        $jml = 0;

        foreach($cis as $key=>$row)
        {
            $konsultan = $row->konsultan;
            foreach($konsultan as $kk=>$kons)
            {
                $jml = $jml + count($kons->kegiatan);
            }

            $cis[$key]->jml_kegiatan = $jml;
            $jml = 0;
        }

        $data = array(
            'title' => 'Data Kegiatan',
            'cis' => $cis
        );
        return view('common.kegiatan',$data);
    }

    public function getKegiatanByLembaga($id)
    {
        $data = array(
            'title' => 'Detail Kegiatan',
            'data' => $this->cis->getKegiatanById($id)
        );
        return view('common.kegiatan_by_lembaga',$data);
    }

    public function getPenerima()
    {
        $data = array(
            'title' => 'Jumlah Penerima',
            'data' => $this->kegiatan->jmlPesertaKegiatanPerTahun()
        );

        return view('common.penerima',$data);

    }
}
