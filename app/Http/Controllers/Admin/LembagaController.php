<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 07/02/2017
 * Time: 13:40
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\LembagaRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use App\Repositories\TingkatsRepository;
use Illuminate\Http\Request;

class LembagaController extends Controller
{
    protected $lembaga;
    protected $provinces;
    protected $tingkat;
    protected $regencies;

    public function __construct(LembagaRepository $lembaga,
                                ProvincesRepository $provinces,
                                TingkatsRepository $tingkat, RegenciesRepository $regencies)
    {
        $this->lembaga = $lembaga;
        $this->provinces = $provinces;
        $this->tingkat = $tingkat;
        $this->regencies = $regencies;
    }

    public function profile()
    {
        $data = array(
            'head_title' => 'Lembaga',
            'title' => 'Profil Lembaga',
            'data' => $this->lembaga->getLembagaForAdmin()
        );

        return view('dashboard.admin.lembaga.profil',$data);
    }

    public function editProfile()
    {
        $data = array(
            'head_title' => 'Lembaga',
            'title' => 'Edit Lembaga',
            'tingkat' => $this->tingkat->getAll(),
            'provinces' => $this->provinces->getAll(),
            'regencies' => $this->regencies->getAll(),
            'data' => $this->lembaga->getLembagaForAdmin()
        );

        return view('dashboard.admin.lembaga.edit',$data);
    }

    public function doUpdate(Request $request, $id)
    {
        $data = $request->all();
        $result = $this->lembaga->update($id,$data);
        if($result)
        {
            return redirect('adm/lembaga/profil')->with('info','Data Lembaga Berhasil Diupdate');
        }
    }
}