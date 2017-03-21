<?php

namespace App\Http\Controllers;

use App\Repositories\DistrictsRepository;
use App\Repositories\KumkmRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use App\Repositories\SentraKumkmRepository;
use App\Repositories\UserRepository;
use App\Repositories\VillagesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KumkmController extends Controller
{
    protected $kumkm;
    protected $userrepo;
    protected $provinces;
    protected $regencies;
    protected $districts;
    protected $villages;
    protected $sentra;

    public function __construct(KumkmRepository $kumkmRepository,
                                UserRepository $userRepository,
                                ProvincesRepository $provincesRepository,
                                RegenciesRepository $regenciesRepository,
                                DistrictsRepository $districtsRepository,
                                VillagesRepository $villagesRepository,
                                SentraKumkmRepository $sentraKumkmRepository)
    {
        $this->kumkm = $kumkmRepository;
        $this->userrepo = $userRepository;
        $this->provinces = $provincesRepository;
        $this->regencies = $regenciesRepository;
        $this->districts = $districtsRepository;
        $this->villages = $villagesRepository;
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
        );

        if(Auth::user()->role_id==2)
        {
            $sentra = $this->sentra->getSentraByAdmin();
        }
        elseif(Auth::user()->role_id==3)
        {
            $sentra = $this->sentra->getSentraByKosultan();
        }
        elseif(Auth::user()->role_id==1)
        {
            $sentra = $this->sentra->getAll();
        }

        $data['sentra'] = $sentra;
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
            'sentra'            => 'nullable',
            'sentra_id'         => 'nullable',
            'tk_tetap'          => 'required|numeric',
            'tk_tidak_tetap'    => 'required|numeric',
            'email'             => 'required|email|unique:users',
            'telp'              => 'nullable|numeric',
            'alamat'            => 'required',
            'provinces_id'      => 'required',
            'regency_id'        => 'required',
            'district_id'       => 'required',
            'village_id'        => 'required',
        );

        $messages = array(
            'id_kumkm.numeric'      => 'ID KUMKM Harus terisi angka',
            'nama_usaha.required'   => 'Nama usaha tidak boleh kosong',
            'nama_pemilik.required' => 'Nama Pemilik tidak boleh kosong',
            'no_ktp.numeric'        => 'No KTP harus terisi angka',
            'npwp.numeric'          => 'NPWP harus terisi angka',
            'tk_tetap.required'     => 'Tenaga Kerja Tetap tidak boleh kosong',
            'tk_tetap.numeric'      => 'Harus terisi angka bukan huruf',
            'tk_tidak_tetap.reuired'=> 'Tenaga Kerja Tidak Tetap tidak boleh kosong',
            'tk_tidak_tetap.numeric'=> 'Harus terisi angka bukan huruf',
            'email.required'        => 'Email tidak boleh kosong',
            'email.email'           => 'Format email tidak benar',
            'email.unique'          => 'Email sudah terdaftar pada sistem/Ganti dengan yang lain',
            'telp.numeric'          => 'No Telp Harus terisi angka',
            'alamat.required'       => 'Alamat harus terisi',
            'provinces_id.required' => 'Provinsi harus dipilih',
            'regency_id.required'   => 'Kabupaten/Kota harus dipilih',
            'district_id.required'  => 'Kecamatan harus dipilih',
            'village_id.required'   => 'Kelurahan harus dipilih',
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

        if(Auth::user()->role_id==2)
        {
            $lembaga_id = Auth::user()->adminlembagas->lembaga_id;
            $data['lembaga_id'] = $lembaga_id;
        }
        elseif(Auth::user()->role_id==3)
        {
            $lembaga_id = Auth::user()->konsultans->lembaga_id;
            $data['lembaga_id'] = $lembaga_id;
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
        $rowdata = $this->kumkm->getById($id);
        $data = array(
            'title' => 'Edit Data KUMKM',
            'data'  => $rowdata,
            'provinces' => $this->provinces->getAll(),
            'regencies' => $this->regencies->getByProvinces($rowdata->provinces_id),
            'districts' => $this->districts->getByRegencies($rowdata->regency_id),
            'villages'  => $this->villages->getByDistrict($rowdata->district_id),
            'sentra'    => $this->sentra->getSentraByAdmin(),
        );
        return view('kumkm.edit',$data);
    }

    public function doEdit(Request $request,$id)
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
            'sentra'            => 'nullable',
            'sentra_id'         => 'nullable',
            'tk_tetap'          => 'nullable|numeric',
            'tk_tidak_tetap'    => 'nullable|numeric',
            'email'             => 'required|email',
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
            'telp.numeric'          => 'No Telp Harus terisi angka'
        );
        $validator = Validator::make($data,$rules,$messages);

        if($validator->fails())
        {
            return redirect('kumkm/'.$id)
                ->withInput()
                ->withErrors($validator);
        }

        $result = $this->kumkm->update($id,$data);
        if($result)
        {
            return redirect('kumkm')->with('success','Berhasil ! Akun KUMKM telah berhasil dibuat');
        }
        else
        {
            return redirect('kumkm')->with('error','Maaf ! Terjadi kesalahan dalam sistem silhkan hubungi Administrator');
        }
    }

    public function delete($id)
    {
        return 'delete';
    }
}
