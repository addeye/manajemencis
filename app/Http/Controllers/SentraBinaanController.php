<?php

namespace App\Http\Controllers;

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
            return redirect('cislembaga/'.$request->cis_lembaga_id.'/detail')->with('success','Data CIS PLUT-KUMKM Berhasil Disimpan');
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
