<?php

namespace App\Http\Controllers;

use App\Repositories\KontakRepository;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    protected $kontak;

    public function __construct(KontakRepository $kontakRepository)
    {
        $this->kontak = $kontakRepository;
    }

    public function index()
    {
        $data=array(
            'title' => 'Update Kontak',
            'data' => $this->kontak->getById(1)
        );

        return view('kontak.form',$data);
    }

    public function doEdit(Request $request)
    {
        $data =  $request->all();

        $result = $this->kontak->update(1,$data);
        if($result)
        {
            return redirect('set_kontak')->with('info','Data Kontak Berhasil Diupdate');
        }
    }

    public function tampil()
    {
        $data=array(
            'data' => $this->kontak->getById(1)
        );
        return view('kontak.tampil',$data);
    }
}
