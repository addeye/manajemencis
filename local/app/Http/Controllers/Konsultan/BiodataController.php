<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 03/02/2017
 * Time: 13:04
 */

namespace App\Http\Controllers\Konsultan;


use App\Http\Controllers\Controller;
use App\Repositories\BidangLayananRepository;
use App\Repositories\CisLembagaRepository;
use App\Repositories\KonsultanRepository;
use App\Repositories\LembagaRepository;
use App\Repositories\PendidikanRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class BiodataController extends Controller
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
                                BidangLayananRepository $bidanglayanan,
                                CisLembagaRepository $cisLembagaRepository)
    {
        $this->konsultan = $konsultan;
        $this->provinces = $provinces;
        $this->regencies = $regencies;
        $this->pendidikan = $pendidikan;
        $this->lembaga = $cisLembagaRepository;
        $this->bidanglayanan = $bidanglayanan;
    }

    public function index()
    {
        $data = Array
        (
            'title' => 'Biodata Konsultan',
            'data' => $this->konsultan->getByUserId(Auth::user()->id)

        );
//        return $data;
        return view('dashboard.konsultan.detail',$data);
    }

    public function editData()
    {
        $data = array(
            'title' => 'Edit Biodata Konsultan',
            'provinces' => $this->provinces->getAll(),
            'regencies' => $this->regencies->getAll(),
            'pendidikan' => $this->pendidikan->getAll(),
            'lembaga' => $this->lembaga->getAll(),
            'bidanglayanan' => $this->bidanglayanan->getAll(),
            'data' => $this->konsultan->getByUserId(Auth::user()->id)
        );
        return view('dashboard.konsultan.edit',$data);
    }

    public function doEditData(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'ijazah' => 'image|max:1024',
            'sertifikat_1' => 'image|max:1024',
            'sertifikat_2' => 'image|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect('bio/konsultan/edit')
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('ijazah'))
        {
            $files = Input::file('ijazah');
            //getting timestamp
            $timestamp = str_replace(['',':'],' Ijazah -',Carbon::now()->toDateTimeString());
            $name = $timestamp.'-'.$files->getClientOriginalName();
            $data['ijazah'] = $name;
            $files->move(public_path().'/lampiran/',$name);
        }
        if($request->hasFile('sertifikat_1'))
        {
            $files = Input::file('sertifikat_1');
            //getting timestamp
            $timestamp = str_replace(['',':'],' Sertifikat1 -',Carbon::now()->toDateTimeString());
            $name = $timestamp.'-'.$files->getClientOriginalName();
            $data['sertifikat_1'] = $name;
            $files->move(public_path().'/lampiran/',$name);
        }
        if($request->hasFile('sertifikat_2'))
        {
            $files = Input::file('sertifikat_2');
            //getting timestamp
            $timestamp = str_replace(['',':'],' sertifikat2 -',Carbon::now()->toDateTimeString());
            $name = $timestamp.'-'.$files->getClientOriginalName();
            $data['sertifikat_2'] = $name;
            $files->move(public_path().'/lampiran/',$name);
        }

        $result = $this->konsultan->update($id,$data);
        if($result)
        {
            return redirect('bio/konsultan')->with('info','Data Bidang Layanan Berhasil Diupdate');
        }
    }

}