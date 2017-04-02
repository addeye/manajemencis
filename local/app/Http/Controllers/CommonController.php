<?php

namespace App\Http\Controllers;

use App\Cis_lembaga;
use App\Jenis_layanan;
use App\Repositories\BidangLayananRepository;
use App\Repositories\CisLembagaRepository;
use App\Repositories\DetailsProkersRepository;
use App\Repositories\DistrictsRepository;
use App\Repositories\InformasiPasarRepository;
use App\Repositories\KegiatanKonsultanRepository;
use App\Repositories\KonsultanRepository;
use App\Repositories\KonsultasiRepository;
use App\Repositories\PengumumanRepository;
use App\Repositories\ProkerKonsultanRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use App\Repositories\SentraKumkmRepository;
use App\Repositories\VillagesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $konsultasi;
    protected $pengumuman;
    protected $informasi;

    public function __construct(ProvincesRepository $provinces,
                                RegenciesRepository $regencies,
                                DistrictsRepository $districts,
                                VillagesRepository $villages,
                                DetailsProkersRepository $dproker,
                                Jenis_layanan $jenis_layanan,
                                SentraKumkmRepository $sentraKumkmRepository,
                                CisLembagaRepository $cisLembagaRepository,
                                BidangLayananRepository $bidangLayananRepository,
                                KegiatanKonsultanRepository $kegiatanKonsultanRepository,
                                KonsultasiRepository $konsultasiRepository,
                                PengumumanRepository $pengumumanRepository,
                                InformasiPasarRepository $informasiPasarRepository)
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
        $this->konsultasi = $konsultasiRepository;
        $this->pengumuman = $pengumumanRepository;
        $this->informasi = $informasiPasarRepository;
    }

    public function getRegencies($provinces_id)
    {
        $data['regencies'] = $this->regencies->getByProvinces($provinces_id);
        return view('common.regencies',$data);
    }

    public function getFfRegencies($provinces_id)
    {
        $data['regencies'] = $this->regencies->getByProvinces($provinces_id);
        return view('common.regencies_ff',$data);
    }

    public function getDistricts($regencies_id)
    {
        $data['districts'] = $this->districts->getByRegencies($regencies_id);
        return view('common.districts',$data);
    }

    public function getFfDistricts($regencies_id)
    {
        $data['districts'] = $this->districts->getByRegencies($regencies_id);
        return view('common.districts_ff',$data);
    }

    public function getVillages($districts_id)
    {
        $data['villages'] = $this->villages->getByDistrict($districts_id);
        return view('common.villages',$data);
    }

    public function getFfVillages($districts_id)
    {
        $data['villages'] = $this->villages->getByDistrict($districts_id);
        return view('common.villages_ff',$data);
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
        if(Auth::user())
        {
            return view('common.sentra_umkm_auth',$data);
        }
        else
        {
            return view('common.sentra_umkm',$data);
        }
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
        if(Auth::user())
        {
            return view('common.kegiatan_auth',$data);
        }
        else
        {
            return view('common.kegiatan',$data);
        }
    }

    public function getKegiatanByLembaga($id)
    {
        $data = array(
            'title' => 'Detail Kegiatan',
            'data' => $this->cis->getKegiatanById($id)
        );
        if(Auth::user())
        {
            return view('common.kegiatan_by_lembaga_auth',$data);
        }
        else
        {
            return view('common.kegiatan_by_lembaga',$data);
        }
    }

    public function getPenerima()
    {
        $data = array(
            'title' => 'Jumlah Penerima',
            'data' => $this->kegiatan->jmlPesertaKegiatanPerTahun()
        );
        if(Auth::user())
        {
            return view('common.penerima_auth',$data);
        }
        else
        {
            return view('common.penerima',$data);
        }


    }

    public function getKonsultasi()
    {
        $data = array(
            'title' => 'Konsultasi',
            'konsultasi' => $this->konsultasi->getAll()
        );
        return view('common.konsultasi',$data);
    }

    public function getInfo()
    {
        $data = array(
            'title' => 'Info Terbaru',
            'pengumuman' => $this->pengumuman->getAll()
        );
        return view('common.info_terkini',$data);
    }

    public function getInformasiPasar()
    {
        $data = array(
            'title' => 'Informasi Pasar',
            'informasi' => $this->informasi->getAll()
        );
        return view('common.informasi_pasar',$data);
    }
}
