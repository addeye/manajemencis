<?php

namespace App\Http\Controllers;

use App\Repositories\BidangLayananRepository;
use App\Repositories\KonsultasiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $data =  $request->all();
        $rules = array(
            'nama'                  => 'required',
            'email'                 => 'required|email',
            'telp'                  => 'required|numeric',
            'alamat'                => 'nullable',
            'produk'                => 'nullable',
            'permasalahan_bisnis'   => 'required'
        );

        $message =array(
            'nama.required'                 => 'Nama tidak boleh kosong',
            'email.required'                => 'Email tidak boleh kosong',
            'email.email'                   => 'Isi kan alamat email dengan benar',
            'telp.required'                 => 'No telp tidak boleh kosong',
            'telp.numeric'                  => 'Inputan Telp harus terisi angka',
            'permasalahan_bisnis.required'  => 'Sertakan permasalahan bisnis anda'
        );

        $validator = Validator::make($data,$rules,$message);
        if($validator->fails())
        {
            return redirect('konsultasi')
                ->withErrors($validator)
                ->withInput();
        }

        $result = $this->konsultasi->create($data);
        if($result)
        {
            return redirect('konsultasi')->with('success','Terimakasih ! Formulir anda sudah kami terima informasi selanjutnya cek melalui Email anda');
        }
        else
        {
            return redirect('konsultasi')->with('error','Maaf ! Terjadi kesalahan dalam sistem silhkan hubungi Administrator');
        }
    }
}
