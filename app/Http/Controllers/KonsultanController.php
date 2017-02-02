<?php

namespace App\Http\Controllers;

use App\Repositories\BidangLayananRepository;
use App\Repositories\KonsultanRepository;
use App\Repositories\LembagaRepository;
use App\Repositories\PendidikanRepository;
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

    public function __construct(KonsultanRepository $konsultan,
                                ProvincesRepository $provinces,
                                RegenciesRepository $regencies,
                                PendidikanRepository $pendidikan,
                                LembagaRepository $lembaga, BidangLayananRepository $bidanglayanan)
    {
        $this->konsultan = $konsultan;
        $this->provinces = $provinces;
        $this->regencies = $regencies;
        $this->pendidikan = $pendidikan;
        $this->lembaga = $lembaga;
        $this->bidanglayanan = $bidanglayanan;
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
            'title' => 'Laporan Data Konsultan',
            'konsultan' => $this->konsultan->getAll()

        );
        return view('konsultan.k_report',$data);
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
            'images' => 'required|image|max:1024',
            'ijazah' => 'image|max:1024',
            'sertifikat_1' => 'image|max:1024',
            'sertifikat_2' => 'image|max:1024',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return redirect('konsultan/create')
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('images'))
        {
            $files = Input::file('images');
            //getting timestamp
                $timestamp = str_replace(['',':'],' pp -',Carbon::now()->toDateTimeString());
                $name = $timestamp.'-'.$files->getClientOriginalName();
                $data['path'] = $name;
                $files->move(public_path().'/images/',$name);
        }
        if($request->hasFile('ijazah'))
        {
            $files = Input::file('ijazah');
            //getting timestamp
            $timestamp = str_replace(['',':'],' Ijazah -',Carbon::now()->toDateTimeString());
            $name = $timestamp.'-'.$files->getClientOriginalName();
            $data['ijazah'] = $name;
            $files->move(public_path().'/images/',$name);
        }
        if($request->hasFile('sertifikat_1'))
        {
            $files = Input::file('sertifikat_1');
            //getting timestamp
            $timestamp = str_replace(['',':'],' Sertifikat1 -',Carbon::now()->toDateTimeString());
            $name = $timestamp.'-'.$files->getClientOriginalName();
            $data['sertifikat_1'] = $name;
            $files->move(public_path().'/images/',$name);
        }
        if($request->hasFile('sertifikat_2'))
        {
            $files = Input::file('sertifikat_2');
            //getting timestamp
            $timestamp = str_replace(['',':'],' sertifikat2 -',Carbon::now()->toDateTimeString());
            $name = $timestamp.'-'.$files->getClientOriginalName();
            $data['sertifikat_2'] = $name;
            $files->move(public_path().'/images/',$name);
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
}
