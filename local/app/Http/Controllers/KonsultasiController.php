<?php

namespace App\Http\Controllers;

use App\Repositories\BidangLayananRepository;
use App\Repositories\KonsultasiRepository;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    protected $konsultasi;
    protected $bidanglayanan;

    public function __construct(KonsultasiRepository $konsultasiRepository, BidangLayananRepository $bidangLayananRepository)
    {
        $this->konsultasi = $konsultasiRepository;
        $this->bidanglayanan = $bidangLayananRepository;
    }

    public function index()
    {
        $data=array(
            'title' => 'Daftar Konsultasi Masuk',
            'konsultasi' => $this->konsultasi->getAll()
        );

        return view('konsultasi.list',$data);
    }

    public function add()
    {
        $data = array(
            'bidanglayanan' => $this->bidanglayanan->getAll()
        );
        return view('konsultasi.add',$data);
    }

    public function doAdd(Request $request)
    {
        return $request->all();
    }
}
