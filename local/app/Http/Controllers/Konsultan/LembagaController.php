<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 03/02/2017
 * Time: 10:19
 */

namespace App\Http\Controllers\Konsultan;


use App\Http\Controllers\Controller;
use App\Http\Traits\UploadTrait;
use App\Repositories\CisLembagaRepository;
use App\Repositories\KonsultanRepository;
use App\Repositories\LembagaRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use App\Repositories\TingkatsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class LembagaController extends Controller
{
    use UploadTrait;

    protected $lembaga;
    protected $konsultan;
    protected $userid;
    protected $lembaga_id;
    protected $tingkat;
    protected $provinces;
    protected $regencies;
    protected $cislembaga;

    public function __construct(LembagaRepository $lembaga,
                                KonsultanRepository $konsultan,
                                TingkatsRepository $tingkat,
                                ProvincesRepository $provinces,
                                RegenciesRepository $regencies, CisLembagaRepository $cisLembagaRepository)
    {
        $this->lembaga = $lembaga;
        $this->konsultan = $konsultan;
        $this->tingkat = $tingkat;
        $this->provinces = $provinces;
        $this->regencies = $regencies;
        $this->cislembaga = $cisLembagaRepository;
    }

    public function getLembaga()
    {
        $data = array(
            'title' => 'Edit Lembaga',
            'tingkat' => $this->tingkat->getAll(),
            'provinces' => $this->provinces->getAll(),
            'regencies' => $this->regencies->getAll(),
            'data' => $this->cislembaga->getLembagaForKonsultan()
        );
        return view('lembaga.konsultan.edit_lembaga',$data);
    }

    public function detailData()
    {
        $data = Array
        (
            'title' => 'Detail Lembaga',
            'data' => $this->cislembaga->getLembagaForKonsultan()

        );
        return view('lembaga.konsultan.detail_lembaga',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = $request->all();

        $cislembaga = $this->cislembaga->getById($id);
        $oldfile = $cislembaga->photo_gedung;

        if($request->hasFile('photo_gedung'))
        {
            $file = Input::file('photo_gedung');
            $name = $this->upload_image($file,'images',$oldfile);
            $data['photo_gedung'] = $name;
        }

        $result = $this->cislembaga->update($id,$data);
        if($result)
        {
            return redirect('k/lembaga/detail')->with('info','Data Lembaga '.$data['plut_name'].' Sudah Di Update');
        }
    }
}