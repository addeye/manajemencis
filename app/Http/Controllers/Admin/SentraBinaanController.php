<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\SentraBinaanRepository;
use Illuminate\Http\Request;

class SentraBinaanController extends Controller
{
    protected $sentrabinaan;

    public function __construct(SentraBinaanRepository $sentraBinaanRepository)
    {
        $this->sentrabinaan = $sentraBinaanRepository;
    }

    public function doAddData(Request $request)
    {
        $data = $request->all();
        $result = $this->sentrabinaan->create($data);
        if($result)
        {
            return redirect('adm/lembaga/profil')->with('success','Data CIS PLUT-KUMKM Berhasil Disimpan');
        }
    }

    public function deleteData($id)
    {
        $result = $this->sentrabinaan->delete($id);
        if($result)
        {
            return redirect()->back()->with('info','Data Sentra Binaan Berhasil Disimpan');
        }
    }
}
