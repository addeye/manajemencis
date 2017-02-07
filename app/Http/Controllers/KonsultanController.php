<?php

namespace App\Http\Controllers;

use App\Repositories\BidangLayananRepository;
use App\Repositories\DetailsProkersRepository;
use App\Repositories\KonsultanRepository;
use App\Repositories\LembagaRepository;
use App\Repositories\PendidikanRepository;
use App\Repositories\ProkerKonsultanRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class KonsultanController extends Controller
{
    protected $konsultan;
    protected $provinces;
    protected $regencies;
    protected $pendidikan;
    protected $lembaga;
    protected $bidanglayanan;
    protected $proker;
    protected $detailproker;

    public function __construct(KonsultanRepository $konsultan,
                                ProvincesRepository $provinces,
                                RegenciesRepository $regencies,
                                PendidikanRepository $pendidikan,
                                LembagaRepository $lembaga,
                                BidangLayananRepository $bidanglayanan,
                                ProkerKonsultanRepository $proker,
                                DetailsProkersRepository $detailproker)
    {
        $this->konsultan = $konsultan;
        $this->provinces = $provinces;
        $this->regencies = $regencies;
        $this->pendidikan = $pendidikan;
        $this->lembaga = $lembaga;
        $this->bidanglayanan = $bidanglayanan;
        $this->proker = $proker;
        $this->detailproker = $detailproker;
    }

    public function getAll()
    {
        $data = Array
        (
            'title' => 'Data Konsultan',
            'konsultan' => $this->konsultan->getAll()
        );
        return view('konsultan.k_list',$data);
    }

    public function getAllReport()
    {
        $data = Array
        (
            'head_title' => 'Laporan Data Konsultan',
            'title' => 'Laporan Data Konsultan',
            'konsultan' => $this->konsultan->getAll()

        );
        return view('konsultan.k_report',$data);
    }

    public function detailData($id)
    {
        $data = Array
        (
            'title' => 'Detail Data Konsultan',
            'data' => $this->konsultan->getById($id)

        );
        return view('konsultan.k_detail',$data);
    }

    public function prokerData($id)
    {
        $data = array(
            'title' => 'Program Kerja',
            'data' => $this->proker->getAllByKonsultanId($id)
        );
        return view('konsultan.k_proker',$data);
    }

    public function detailProker($id)
    {
        $data = array(
            'title' => 'Detail Program Kerja',
            'data' => $this->detailproker->getAllByProker($id)
        );
        return view('konsultan.k_detailproker',$data);
    }

    public function addData()
    {
        $data = Array
        (
            'title' => 'Tambah Konsultan',
            'provinces' => $this->provinces->getAll(),
            'regencies' => $this->regencies->getAll(),
            'pendidikan' => $this->pendidikan->getAll(),
            'lembaga' => $this->lembaga->getAll(),
            'bidanglayanan' => $this->bidanglayanan->getAll()
        );
        return view('konsultan.k_add',$data);
    }

    public function doAddData(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'ijazah' => 'image|max:500',
            'sertifikat_1' => 'image|max:500',
            'pas_photo' => 'image|max:500',
            'scan_ktp' => 'image|max:500',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return redirect('konsultan/create')
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('pas_photo'))
        {
            $files = Input::file('pas_photo');
            $name = $this->upload_image($files,'images');
            $data['pas_photo'] = $name;
        }
        if($request->hasFile('ijazah'))
        {
            $files = Input::file('ijazah');
            $name = $this->upload_image($files,'lampiran');
            $data['ijazah'] = $name;
        }
        if($request->hasFile('scan_ktp'))
        {
            $files = Input::file('scan_ktp');
            //getting timestamp
            $name = $this->upload_image($files,'lampiran');
            $data['scan_ktp'] = $name;
        }
        if($request->hasFile('sertifikat_1'))
        {
            $files = Input::file('sertifikat_1');
            //getting timestamp
            $name = $this->upload_image($files,'lampiran');
            $data['sertifikat_1'] = $name;
        }

        $result = $this->konsultan->create($data);
        if($result)
        {
            return redirect('konsultan')->with('success','Data Konsultan Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = array(
            'title' => 'Edit Data Konsultan',
            'provinces' => $this->provinces->getAll(),
            'regencies' => $this->regencies->getAll(),
            'pendidikan' => $this->pendidikan->getAll(),
            'lembaga' => $this->lembaga->getAll(),
            'bidanglayanan' => $this->bidanglayanan->getAll(),
            'data' => $this->konsultan->getById($id)
        );
        return view('konsultan.k_edit',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = $request->all();
        $old = $this->konsultan->getById($id);

        if($request->hasFile('pas_photo'))
        {
            $files = Input::file('pas_photo');
            $name = $this->upload_image($files,'images',$old->pas_photo);
            $data['pas_photo'] = $name;
        }
        if($request->hasFile('ijazah'))
        {
            $files = Input::file('ijazah');
            $name = $this->upload_image($files,'lampiran',$old->ijazah);
            $data['ijazah'] = $name;
        }
        if($request->hasFile('scan_ktp'))
        {
            $files = Input::file('scan_ktp');
            //getting timestamp
            $name = $this->upload_image($files,'lampiran',$old->scan_ktp);
            $data['scan_ktp'] = $name;
        }
        if($request->hasFile('sertifikat_1'))
        {
            $files = Input::file('sertifikat_1');
            //getting timestamp
            $name = $this->upload_image($files,'lampiran',$old->sertifikat_1);
            $data['sertifikat_1'] = $name;
        }

        $result = $this->konsultan->update($id,$data);
        if($result)
        {
            return redirect('konsultan')->with('info','Data Bidang Layanan Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->konsultan->delete($id);
        if($result)
        {
            return redirect('konsultan')->with('info','Data Konsultan Berhasil Dihapus');
        }
    }

    public function upload_image($files,$dir,$old='')
    {
        //getting timestamp
        $timestamp = str_replace(['',':'],' pp -',Carbon::now()->toDateTimeString());
        $name = $timestamp.'-'.$files->getClientOriginalName();
        $files->move(public_path().'/'.$dir.'/',$name);
        if($old!='' and file_exists(public_path().'/'.$dir.'/'.$old))
        {
            unlink(public_path().'/'.$dir.'/'.$old);
        }
        return $name;
    }
}
