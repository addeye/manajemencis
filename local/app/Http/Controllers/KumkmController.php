<?php

namespace App\Http\Controllers;

use App\Repositories\KumkmRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\SentraKumkmRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KumkmController extends Controller
{
    protected $kumkm;
    protected $userrepo;
    protected $provinces;
    protected $sentra;

    public function __construct(KumkmRepository $kumkmRepository,
                                UserRepository $userRepository,
                                ProvincesRepository $provincesRepository, SentraKumkmRepository $sentraKumkmRepository)
    {
        $this->kumkm = $kumkmRepository;
        $this->userrepo = $userRepository;
        $this->provinces = $provincesRepository;
        $this->sentra = $sentraKumkmRepository;
    }

    public function index()
    {
        $data=array(
            'title' => 'Data Kumkm',
            'kumkm' => $this->kumkm->getAll()
        );

        return view('kumkm.list',$data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Tambah Data KUMKM',
            'provinces' => $this->provinces->getAll(),
            'sentra'    => $this->sentra->getSentraByAdmin()
        );
        return view('kumkm.add',$data);
    }

    public function doAdd(Request $request)
    {
        $data = $request->all();
        $rules = array(
            'id_kumkm'          => 'nullable|numeric',
            'nama_usaha'        => 'required',
            'nama_pemilik'      => 'required',
            'no_ktp'            => 'nullable|numeric',
            'npwp'              => 'nullable|numeric',
            'badan_usaha'       => 'nullable',
            'ket_badan_usaha'   => 'nullable',
            'tgl_mulai_usaha'   => 'nullable',
            'sektor_usaha'      => 'nullable',
            'skala_usaha'       => 'nullable',
            'usaha_utama'       => 'nullable',
            'hasil_produk'      => 'nullable',
            'sentra_id'         => 'nullable',
            'tk_tetap'          => 'nullable|numeric',
            'tk_tidak_tetap'    => 'nullable|numeric',
            'email'             => 'required|email|unique:users',
            'telp'              => 'nullable|numeric',
            'alamat'            => 'nullable',
            'provinces_id'      => 'nullable',
            'regency_id'        => 'nullable',
            'district_id'       => 'nullable',
            'village_id'        => 'nullable',
        );

        $messages = array(
            'id_kumkm.numeric'      => 'ID KUMKM Harus terisi angka',
            'nama_usaha.required'   => 'Nama usaha tidak boleh kosong',
            'nama_pemilik.required' => 'Nama Pemilik tidak boleh kosong',
            'no_ktp.numeric'        => 'No KTP harus terisi angka',
            'npwp.numeric'          => 'NPWP harus terisi angka',
            'tk_tetap.numeric'      => 'Harus terisi angka',
            'tk_tidak_tetap.numeric'=> 'Harus terisi angka',
            'email.required'        => 'Email tidak boleh kosong',
            'email.email'           => 'Format email tidak benar',
            'email.unique'          => 'Email sudah terdaftar pada sistem/Ganti dengan yang lain',
            'telp.numeric'          => 'No Telp Harus terisi angka'
        );
        $validator = Validator::make($data,$rules,$messages);

        if($validator->fails())
        {
            return redirect('kumkm/create')
                ->withInput()
                ->withErrors($validator);
        }

        $datauser = array(
            'name'      => $request->nama_usaha,
            'role_id'   => 4,
            'email'     => $request->email,
            'password'  => bcrypt('1234'),
        );

        $result_user = $this->userrepo->create($datauser);
        if(!$result_user)
        {
            return redirect('kumkm')->with('error','Gagal ! Akun KUMKM telah gagal dibuat');
        }

        $result = $this->kumkm->create($data);
        if($result)
        {
            return redirect('kumkm')->with('success','Berhasil ! Akun KUMKM telah berhasil dibuat');
        }
        else
        {
            return redirect('kumkm')->with('error','Maaf ! Terjadi kesalahan dalam sistem silhkan hubungi Administrator');
        }
    }

    public function edit($id)
    {
        $data = array(
            'title' => 'Edit Data KUMKM',
            'data'  => $this->kumkm->getById($id)
        );
        return view('kumkm.edit',$data);
    }

    public function doEdit(Request $request,$id)
    {
        $data = $request->all();
        $rules = array(
            'id_kumkm'      => 'nullable',
            'nama_usaha'    => 'required',
            'email'         => 'required|email|unique:users',
            'telp'          => 'nullable|numeric',
        );

        $messages = array(
            'nama_usaha.required'   => 'Nama usaha tidak boleh kosong',
            'email.required'        => 'Email tidak boleh kosong',
            'email.email'           => 'Format email tidak benar',
            'email.unique'          => 'Email sudah terdaftar pada sistem/Ganti dengan yang lain',
            'telp.numeric'          => 'No Telp Harus terisi angka'
        );
        $validator = Validator::make($data,$rules,$messages);

        if($validator->fails())
        {
            return redirect('kumkm/'.$id.'update')
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function delete($id)
    {
        return 'delete';
    }
}
