<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BidangUsahaRepository;
use App\Repositories\DistrictsRepository;
use App\Repositories\LembagaRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use App\Repositories\SentraKumkmRepository;
use App\Repositories\VillagesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SentraKumkmController extends Controller
{
    protected $sentrakumkm;
    protected $provinces;
    protected $regencies;
    protected $disticts;
    protected $villages;
    protected $lembaga;
    protected $bidangusaha;

    public function __construct(SentraKumkmRepository $sentrakumkm,
                                ProvincesRepository $provinces,
                                RegenciesRepository $regencies,
                                DistrictsRepository $disticts,
                                VillagesRepository $villages,
                                LembagaRepository $lembaga, BidangUsahaRepository $bidangusaha)
    {
        $this->sentrakumkm = $sentrakumkm;
        $this->provinces = $provinces;
        $this->regencies = $regencies;
        $this->disticts = $disticts;
        $this->villages = $villages;
        $this->lembaga = $lembaga;
        $this->bidangusaha = $bidangusaha;
    }

    public function getAll()
    {
        $data = array(
            'head_title' => 'Sentra KUMKM',
            'title' => 'Data Sentra KUMKM',
            'data' => $this->sentrakumkm->getSentraByAdmin(),
        );
        return view('dashboard.admin.sentra_kumkm.list',$data);
    }

    public function addData()
    {
        $data = array(
            'head_title' => 'Sentra KUMKM',
            'title' => 'Tambah Data Sentra KUMKM',
            'lembagas' => $this->lembaga->getAll(),
            'provinces' => $this->provinces->getAll(),
            'regencies' => $this->regencies->getAll(),
            'disticts' => $this->disticts->getAll(),
            'villages' => $this->villages->getAll(),
            'bidangusaha' => $this->bidangusaha->getAll(),
            'admin_lembagas' => Auth::user()->adminlembagas->lembaga_id,
        );

        return view('dashboard.admin.sentra_kumkm.add',$data);
    }

    public function editData($id)
    {
        $data = array(
            'head_title' => 'Sentra KUMKM',
            'title' => 'Edit Data Sentra KUMKM',
            'lembagas' => $this->lembaga->getAll(),
            'provinces' => $this->provinces->getAll(),
            'regencies' => $this->regencies->getAll(),
            'districts' => $this->disticts->getAll(),
            'villages' => $this->villages->getAll(),
            'bidangusaha' => $this->bidangusaha->getAll(),
            'data' => $this->sentrakumkm->getById($id)
        );

        return view('sentra_kumkm.edit',$data);
    }

    public function doAddData(Request $request)
    {
        $data = $request->all();
        $data['id_lembaga'] = Auth::user()->adminlembagas->lembaga_id;
//        return $data;
        $result = $this->sentrakumkm->create($data);
        if($result)
        {
            return redirect('adm/sentra')->with('success','Data Sentra KUMKM Berhasil Disimpan');
        }
    }

    public function doEditData(Request $request,$id)
    {
        $data = $request->all();
        $result = $this->sentrakumkm->update($id,$data);
        if($result)
        {
            return redirect('sentra')->with('info','Data Sentra KUMKM Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->sentrakumkm->delete($id);
        if($result)
        {
            return redirect('sentra')->with('info','Data Sentra KUMKM Berhasil Dihapus');
        }
    }

    public function getAllColumn ()
    {
        $data = array(
            'head_title' => 'Sentra KUMKM',
            'title' => 'Laporan Sentra KUMKM',
            'data' => $this->sentrakumkm->getAll(),
        );
        return view('sentra_kumkm.report',$data);
    }
}
