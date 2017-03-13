<?php

namespace App\Http\Controllers;

use App\Repositories\InformasiPasarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InformasiPasarController extends Controller
{
    protected $informasi_pasar;

    public function __construct(InformasiPasarRepository $informasiPasarRepository)
    {
        $this->informasi_pasar = $informasiPasarRepository;
    }

    public function index()
    {
        $data = array(
            'title' => 'Informasi Pasar',
            'informasi' => $this->informasi_pasar->getAll()
        );
        return view('informasi_pasar.list',$data);
    }

    public function add($opsi)
    {
        $data=array(
            'opsi' => $opsi,
            'title' => 'Tambah Informasi Pasar'

        );
        return view('informasi_pasar.add',$data);
    }

    public function doAdd(Request $request)
    {
        $data = $request->all();

        $rules = array(
            'nama_lengkap'  =>  'required',
            'email'         =>  'required|email',
            'telp'          =>  'required|numeric',
            'perusahaan'    =>  'nullable',
            'jenis'         =>  'nullable',
            'nama_produk'   =>  'nullable',
            'jumlah_produk' =>  'nullable|numeric',
            'satuan_produk' =>  'nullable',
            'harga_produk'  =>  'nullable|numeric',
            'spesifikasi'   =>  'nullable',
            'keterangan'    =>  'required',
            'link'          =>  'nullable',
        );

        $message =array(
            'nama_lengkap.required'         =>  'Nama tidak boleh kosong',
            'email.required'                =>  'Email tidak boleh kosong',
            'email.email'                   =>  'Isi kan alamat email dengan benar',
            'telp.required'                 =>  'No telp tidak boleh kosong',
            'telp.numeric'                  =>  'Inputan Telp harus terisi angka',
            'jumlah_produk.numeric'         =>  'Jumlah produk harus angka',
            'harga produk.numeric'          =>  'Harga produk harus angka',
            'keterangan.required'           =>  'Keterangan ini tidak boleh kosong'
        );

        $validator = Validator::make($data,$rules,$message);
        if($validator->fails())
        {
            return redirect('informasi/tambah/'.$request->jenis)
                ->withErrors($validator)
                ->withInput();
        }

        if($request->jenis != 'permintaan' && $request->jenis !='penawaran')
        {
            return redirect('informasi')->with('error','Maaf ! Terjadi kesalahan dalam sistem silhkan hubungi Administrator');
        }

        $result = $this->informasi_pasar->create($data);
        if($result)
        {
            return redirect('informasi')->with('success','Terima kasih ! Informasi selanjutnya cek melalui Email anda');
        }
        else
        {
            return redirect('informasi')->with('error','Maaf ! Terjadi kesalahan dalam sistem silhkan hubungi Administrator');
        }
    }

    public function detail($id)
    {
        $data = array(
            'data' => $this->informasi_pasar->getById($id)
        );
        if(Auth::user())
        {
            return view('informasi_pasar.detail_auth',$data);
        }
        else
        {
            return view('informasi_pasar.detail',$data);
        }
    }

    public function edit($id)
    {
        return 'edit';
    }

    public function doEdit(Request $request,$id)
    {
        return $request->all();
    }

    public function destroy($id)
    {
        return 'delete';
    }
}
