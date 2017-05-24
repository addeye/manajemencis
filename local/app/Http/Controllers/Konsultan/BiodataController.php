<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 03/02/2017
 * Time: 13:04
 */

namespace App\Http\Controllers\Konsultan;


use App\Http\Controllers\Controller;
use App\Http\Traits\UploadTrait;
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
    use UploadTrait;
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

    public function printData($id='')
    {
        if($id)
        {
            $row = $this->konsultan->getByUserId($id);
        }
       else
       {
           $row = $this->konsultan->getByUserId(Auth::user()->id);
       }
        $data = Array
        (
            'title' => 'Biodata Konsultan',
            'data' => $row

        );
//        return $data;
        return view('dashboard.konsultan.print_bio',$data);
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
        $old = $this->konsultan->getById($id);

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
            return redirect('bio/konsultan')->with('info','Data Bidang Layanan Berhasil Diupdate');
        }
    }

}