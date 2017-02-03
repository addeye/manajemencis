<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 03/02/2017
 * Time: 10:19
 */

namespace App\Http\Controllers\Konsultan;


use App\Http\Controllers\Controller;
use App\Repositories\KonsultanRepository;
use App\Repositories\LembagaRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use App\Repositories\TingkatsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LembagaController extends Controller
{
    protected $lembaga;
    protected $konsultan;
    protected $userid;
    protected $lembaga_id;
    protected $tingkat;
    protected $provinces;
    protected $regencies;

    public function __construct(LembagaRepository $lembaga,
                                KonsultanRepository $konsultan,
                                TingkatsRepository $tingkat,
                                ProvincesRepository $provinces, RegenciesRepository $regencies)
    {
        $this->lembaga = $lembaga;
        $this->konsultan = $konsultan;
        $this->tingkat = $tingkat;
        $this->provinces = $provinces;
        $this->regencies = $regencies;
    }

    public function getLembaga()
    {
        $row = $this->konsultan->getByUserId(Auth::user()->id);
        $data = array(
            'title' => 'Edit Lembaga',
            'data' => $row->lembagas,
            'tingkat' => $this->tingkat->getAll(),
            'provinces' => $this->provinces->getAll(),
            'regencies' => $this->regencies->getAll()
        );
        return view('lembaga.konsultan.edit_lembaga',$data);
    }

    public function detailData()
    {
        $row = $this->konsultan->getByUserId(Auth::user()->id);
        $data = Array
        (
            'title' => 'Detail Lembaga',
            'data' => $row->lembagas

        );
        return view('lembaga.konsultan.detail_lembaga',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = $request->all();

        unset($data['_method']);
        unset($data['_token']);

        $result = $this->lembaga->update($id,$data);
        if($result)
        {
            return redirect('k/lembaga/detail')->with('info','Data Lembaga '.$data['name'].' Sudah Di Update');
        }
    }
}