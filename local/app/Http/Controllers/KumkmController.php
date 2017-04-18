<?php

namespace App\Http\Controllers;

use App\Http\Traits\UploadTrait;
use App\Repositories\BidangUsahaRepository;
use App\Repositories\DistrictsRepository;
use App\Repositories\KumkmRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use App\Repositories\SentraKumkmRepository;
use App\Repositories\UserRepository;
use App\Repositories\VillagesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class KumkmController extends Controller
{
    use UploadTrait;
    protected $kumkm;
    protected $userrepo;
    protected $provinces;
    protected $regencies;
    protected $districts;
    protected $villages;
    protected $sentra;
    protected $bidang;

    public function __construct(KumkmRepository $kumkmRepository,
                                UserRepository $userRepository,
                                ProvincesRepository $provincesRepository,
                                RegenciesRepository $regenciesRepository,
                                DistrictsRepository $districtsRepository,
                                VillagesRepository $villagesRepository,
                                SentraKumkmRepository $sentraKumkmRepository,
                                BidangUsahaRepository $bidangUsahaRepository)
    {
        $this->kumkm = $kumkmRepository;
        $this->userrepo = $userRepository;
        $this->provinces = $provincesRepository;
        $this->regencies = $regenciesRepository;
        $this->districts = $districtsRepository;
        $this->villages = $villagesRepository;
        $this->sentra = $sentraKumkmRepository;
        $this->bidang = $bidangUsahaRepository;
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
            'title' => 'Tambah Data KUMKM Form 1/2',
            'provinces' => $this->provinces->getAll(),
            'bidang_usaha' => $this->bidang->getAll()
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
            'bidang_usaha'      => 'nullable',
            'skala_usaha'       => 'nullable',
            'usaha_utama'       => 'nullable',
            'hasil_produk'      => 'nullable',
            'sentra'            => 'nullable',
            'sentra_id'         => 'nullable',
            'tk_tetap'          => 'required|numeric',
            'tk_tidak_tetap'    => 'required|numeric',
            'email'             => 'nullable|email|unique:users',
            'telp'              => 'nullable|numeric',
            'alamat'            => 'required',
            'provinces_id'      => 'required',
            'regency_id'        => 'required',
            'district_id'       => 'required',
            'village_id'        => 'required',
            'foto_usaha'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
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
            'foto_usaha.image'      => 'Format foto tidak sesuai',
        );
        $validator = Validator::make($data,$rules,$messages);

        if($validator->fails())
        {
            return redirect('kumkm/create')
                ->withInput()
                ->withErrors($validator);
        }

        if($request->email=='')
        {
            $rand = mt_rand(100000,999999);
            $email = 'umkm_'.$rand.'@gmail.com';
            $data['email'] = $email;
        }

        $datauser = array(
            'name'      => $request->nama_usaha,
            'role_id'   => 4,
            'email'     => $email,
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

        if($request->hasFile('foto_usaha'))
        {
            $file = Input::file('foto_usaha');
            $name = $this->upload_image($file,'foto_usaha');
            $data['foto_usaha'] = $name;
        }

        $result = $this->kumkm->create($data);
        if($result)
        {
            return redirect('kumkm/detail/'.$result->id)->with('success','Berhasil ! Akun KUMKM telah berhasil dibuat silahkan melengkapi data From Ke 2');
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
            'bidang_usaha' => $this->bidang->getAll()
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
            'sentra_id'           => 'nullable',
            'tk_tetap'          => 'nullable|numeric',
            'tk_tidak_tetap'    => 'nullable|numeric',
            'email'             => 'nullable|email',
            'telp'              => 'nullable|numeric',
            'alamat'            => 'nullable',
            'provinces_id'      => 'nullable',
            'regency_id'        => 'nullable',
            'district_id'       => 'nullable',
            'village_id'        => 'nullable',
            'foto_usaha'        => 'nullable|image'
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
            'telp.numeric'          => 'No Telp Harus terisi angka',
            'foto_usaha.image'      => 'Format foto tidak sesuai',
        );
        $validator = Validator::make($data,$rules,$messages);

        if($validator->fails())
        {
            return redirect('kumkm/'.$id)
                ->withInput()
                ->withErrors($validator);
        }

        $dataKumkm = $this->kumkm->getById($id);
        $oldfile = $dataKumkm->foto_usaha;

        if($request->hasFile('foto_usaha'))
        {
            $file = Input::file('foto_usaha');
            $name = $this->upload_image($file,'foto_usaha',$oldfile);
            $data['foto_usaha'] = $name;
        }

        $result = $this->kumkm->update($id,$data);
        if($result)
        {
            return redirect('kumkm')->with('success','Berhasil ! Akun KUMKM telah berhasil diupdate');
        }
        else
        {
            return redirect('kumkm')->with('error','Maaf ! Terjadi kesalahan dalam sistem silhkan hubungi Administrator');
        }
    }

    public function detail($id)
    {
        $data = array(
            'data' => $this->kumkm->getById($id),
            'title' => 'Tambah Data KUMKM Form 2/2',
        );
        return view('kumkm.detail',$data);
    }

    public function doDetail(Request $request, $id)
    {
        $data = $request->all();

        $rules = array(
            'kas_tunai'=>'nullable|numeric',
            'persediaan'=>'nullable|numeric',
            'harga_tetap'=>'nullable|numeric',
            'kw_bank'=>'nullable|numeric',
            'kw_koperasi'=>'nullable|numeric',
            'kw_lainnya'=>'nullable|numeric',
            'kp_sertifikat'=>'nullable|numeric',
            'kp_tidak_sertifikat'=>'nullable|numeric',
            'om_1thn_lalu'=>'nullable|numeric',
            'om_2thn_lalu'=>'nullable|numeric',
            'lb_1thn_lalu'=>'nullable|numeric',
            'lb_2thn_lalu'=>'nullable|numeric',
            'laporan_regular'=>'required',
            'p1_nama_produk'=>'required',
            'p1_deskripsi'=>'required',
            'p1_harga'=>'required|numeric',
            'p1_foto_produk'=>'nullable|image',
            'p2_nama_produk'=>'nullable',
            'p2_deskripsi'=>'nullable',
            'p2_harga'=>'nullable|numeric',
            'p2_foto_produk'=>'nullable|image',

            'p3_nama_produk'=>'nullable',
            'p3_deskripsi'=>'nullable',
            'p3_harga'=>'nullable|numeric',
            'p3_foto'=>'nullable|image',

            'izin_produk'=>'nullable',
            'izin_usaha_iumk'=>'nullable',
            'izin_usaha_siui'=>'nullable',
            'izin_usaha_siup'=>'nullable',
            'legalitas_lokasi'=>'nullable',
            'jangkauan_pasar'=>'nullable',
            'terima_pendampingan'=>'nullable',
            'masalah_lembaga'=>'nullable',
            'masalah_sdm'=>'nullable',
            'masalah_produksi'=>'nullable',
            'masalah_pembiayaan'=>'nullable',
            'masalah_pemasaran'=>'nullable',
            'masalah_lainnya'=>'nullable',
        );

        $messages = array(
            'kas_tunai.numeric' => 'Harus terisi angka',
            'persediaan.numeric' => 'Harus terisi angka',
            'harga_tetap.numeric' => 'Harus terisi angka',
            'kw_bank.numeric' => 'Harus terisi angka',
            'kw_koperasi.numeric' => 'Harus terisi angka',
            'kw_lainnya.numeric' => 'Harus terisi angka',
            'kp_sertifikat.numeric' => 'Harus terisi angka',
            'kp_tidak_sertifikat.numeric' => 'Harus terisi angka',
            'om_1thn_lalu.numeric' => 'Harus terisi angka',
            'om_2thn_lalu.numeric' => 'Harus terisi angka',
            'lb_1thn_lalu.numeric' => 'Harus terisi angka',
            'lb_2thn_lalu.numeric' => 'Harus terisi angka',
            'laporan_regular.required' => 'Tidak boleh kosong',
            'p1_nama_produk.required' => 'Tidak boleh kosong',
            'p1_deskripsi.required' => 'Tidak boleh kosong',
            'p1_harga.required' => 'Tidak boleh kosong',
            'p1_harga.numeric' => 'Harus terisi angka',
            'p1_foto_produk.image' => 'Format gambar tidak benar',

            'p2_harga.numeric' => 'Harus terisi angka',
            'p2_foto_produk.image' => 'Format gambar tidak benar',

            'p3_harga.numeric' => 'Harus terisi angka',
            'p3_foto.image' => 'Format gambar tidak benar',
        );

        $validator = Validator::make($data,$rules,$messages);
        if($validator->fails())
        {
            return redirect('kumkm/detail/'.$id)
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('p1_foto_produk'))
        {
            $file = Input::file('p1_foto_produk');
            $name = $this->upload_image($file,'produk');
            $data['p1_foto_produk'] = $name;
        }

        if($request->hasFile('p2_foto_produk'))
        {
            $file = Input::file('p2_foto_produk');
            $name = $this->upload_image($file,'produk');
            $data['p2_foto_produk'] = $name;
        }

        if($request->hasFile('p3_foto'))
        {
            $file = Input::file('p3_foto');
            $name = $this->upload_image($file,'produk');
            $data['p3_foto'] = $name;
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

    public function report()
    {
        $data=array(
            'title' => 'Data Kumkm',
            'kumkm' => $this->kumkm->getAll()
        );
        return view('kumkm.report',$data);
    }

    public function delete($id)
    {
        $data = $this->kumkm->getById($id);
        $fotousaha = $data->foto_usaha;
        $produk1 = $data->p1_foto_produk;
        $produk2 = $data->p2_foto_produk;
        $produk3 = $data->p3_foto;
        $this->delete_image('produk',$fotousaha);
        $this->delete_image('produk',$produk1);
        $this->delete_image('produk',$produk2);
        $this->delete_image('produk',$produk3);

        $result = $this->kumkm->delete($id);
        if($result)
        {
            return redirect('kumkm')->with('info','Data Bidang Layanan Berhasil Dihapus');
        }
    }

    public function show($id)
    {
        $data=array(
            'title' => 'Data KMUMK',
            'data'  => $this->kumkm->getById($id)
        );
        return view('kumkm.show',$data);
    }

    public function printData($id)
    {
        $data=array(
            'title' => 'Cetak KMUMK',
            'data'  => $this->kumkm->getById($id)
        );
        return view('kumkm.print',$data);
    }
}
