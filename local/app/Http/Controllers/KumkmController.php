<?php

namespace App\Http\Controllers;

use App\Cis_lembaga;
use App\Http\Traits\UploadTrait;
use App\Kumkm;
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
use Maatwebsite\Excel\Facades\Excel;

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

    public function __construct(
        KumkmRepository $kumkmRepository,
        UserRepository $userRepository,
        ProvincesRepository $provincesRepository,
        RegenciesRepository $regenciesRepository,
        DistrictsRepository $districtsRepository,
        VillagesRepository $villagesRepository,
        SentraKumkmRepository $sentraKumkmRepository,
        BidangUsahaRepository $bidangUsahaRepository
    ) {
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
        $search = Input::get('search');
        $data = [
            'title' => 'Data Kumkm',
            'kumkm' => $this->kumkm->getAll(),
        ];

        if ($search) {
            $data['kumkm'] = $this->kumkm->getBySearch($search);
        }

        return view('kumkm.list', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Data KUMKM Form 1/2',
            'provinces' => $this->provinces->getAll(),
            'bidang_usaha' => $this->bidang->getAll(),
        ];

        if (Auth::user()->role_id == 2) {
            $sentra = $this->sentra->getSentraByAdmin();
        } elseif (Auth::user()->role_id == 3) {
            $sentra = $this->sentra->getSentraByKosultan();
        } elseif (Auth::user()->role_id == 1) {
            $sentra = $this->sentra->getAll();
        }

        $data['sentra'] = $sentra;
        return view('kumkm.add', $data);
    }

    public function doAdd(Request $request)
    {
        $data = $request->all();
        $rules = [
            'id_kumkm' => 'nullable|numeric',
            'nama_usaha' => 'required',
            'nama_pemilik' => 'required',
            'no_ktp' => 'nullable|numeric',
            'npwp' => 'nullable|numeric',
            'badan_usaha' => 'nullable',
            'ket_badan_usaha' => 'nullable',
            'tgl_mulai_usaha' => 'nullable',
            'bidang_usaha' => 'nullable',
            'skala_usaha' => 'nullable',
            'usaha_utama' => 'nullable',
            'hasil_produk' => 'nullable',
            'sentra' => 'nullable',
            'sentra_id' => 'nullable',
            'tk_tetap' => 'required|numeric',
            'tk_tidak_tetap' => 'required|numeric',
            'email' => 'nullable|email|unique:users',
            'telp' => 'nullable|numeric',
            'alamat' => 'required',
            'provinces_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'foto_usaha' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];

        $messages = [
            'id_kumkm.numeric' => 'ID KUMKM Harus terisi angka',
            'nama_usaha.required' => 'Nama usaha tidak boleh kosong',
            'nama_pemilik.required' => 'Nama Pemilik tidak boleh kosong',
            'no_ktp.numeric' => 'No KTP harus terisi angka',
            'npwp.numeric' => 'NPWP harus terisi angka',
            'tk_tetap.required' => 'Tenaga Kerja Tetap tidak boleh kosong',
            'tk_tetap.numeric' => 'Harus terisi angka bukan huruf',
            'tk_tidak_tetap.reuired' => 'Tenaga Kerja Tidak Tetap tidak boleh kosong',
            'tk_tidak_tetap.numeric' => 'Harus terisi angka bukan huruf',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak benar',
            'email.unique' => 'Email sudah terdaftar pada sistem/Ganti dengan yang lain',
            'telp.numeric' => 'No Telp Harus terisi angka',
            'alamat.required' => 'Alamat harus terisi',
            'provinces_id.required' => 'Provinsi harus dipilih',
            'regency_id.required' => 'Kabupaten/Kota harus dipilih',
            'district_id.required' => 'Kecamatan harus dipilih',
            'village_id.required' => 'Kelurahan harus dipilih',
            'foto_usaha.image' => 'Format foto tidak sesuai',
        ];
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return redirect('kumkm/create')
                ->withInput()
                ->withErrors($validator);
        }

        if (!$request->has('email')) {
            $rand = mt_rand(100000, 999999);
            $email = 'umkm_' . $rand . '@gmail.com';
            $data['email'] = $email;
        } else {
            $data['email'] = $request->email;
            $email = $request->email;
        }

        $datauser = [
            'name' => $request->nama_usaha,
            'role_id' => 4,
            'email' => $email,
            'password' => bcrypt('1234'),
        ];

        $result_user = $this->userrepo->create($datauser);
        if (!$result_user) {
            return redirect('kumkm')->with('error', 'Gagal ! Akun KUMKM telah gagal dibuat');
        }

        if (Auth::user()->role_id == 2) {
            $lembaga_id = Auth::user()->adminlembagas->lembaga_id;
            $data['lembaga_id'] = $lembaga_id;
        } elseif (Auth::user()->role_id == 3) {
            $lembaga_id = Auth::user()->konsultans->lembaga_id;
            $data['lembaga_id'] = $lembaga_id;
        }

        if ($request->hasFile('foto_usaha')) {
            $file = Input::file('foto_usaha');
            $name = $this->upload_image($file, 'foto_usaha');
            $data['foto_usaha'] = $name;
        }

        $result = $this->kumkm->create($data);
        if ($result) {
            return redirect('kumkm/detail/' . $result->id)->with('success', 'Berhasil ! Akun KUMKM telah berhasil dibuat silahkan melengkapi data From Ke 2');
        } else {
            return redirect('kumkm')->with('error', 'Maaf ! Terjadi kesalahan dalam sistem silhkan hubungi Administrator');
        }
    }

    public function edit($id)
    {
        $rowdata = $this->kumkm->getById($id);
        $data = [
            'title' => 'Edit Data KUMKM',
            'data' => $rowdata,
            'provinces' => $this->provinces->getAll(),
            'regencies' => $this->regencies->getByProvinces($rowdata->provinces_id),
            'districts' => $this->districts->getByRegencies($rowdata->regency_id),
            'villages' => $this->villages->getByDistrict($rowdata->district_id),
            'bidang_usaha' => $this->bidang->getAll(),
        ];
        if (Auth::user()->role_id == 2) {
            $sentra = $this->sentra->getSentraByAdmin();
        } elseif (Auth::user()->role_id == 3) {
            $sentra = $this->sentra->getSentraByKosultan();
        } elseif (Auth::user()->role_id == 1) {
            $sentra = $this->sentra->getAll();
        }

        $data['sentra'] = $sentra;
        return view('kumkm.edit', $data);
    }

    public function doEdit(Request $request, $id)
    {
        $data = $request->all();
        $rules = [
            'id_kumkm' => 'nullable|numeric',
            'nama_usaha' => 'required',
            'nama_pemilik' => 'required',
            'no_ktp' => 'nullable|numeric',
            'npwp' => 'nullable|numeric',
            'badan_usaha' => 'nullable',
            'ket_badan_usaha' => 'nullable',
            'tgl_mulai_usaha' => 'nullable',
            'sektor_usaha' => 'nullable',
            'skala_usaha' => 'nullable',
            'usaha_utama' => 'nullable',
            'hasil_produk' => 'nullable',
            'sentra' => 'nullable',
            'sentra_id' => 'nullable',
            'tk_tetap' => 'nullable|numeric',
            'tk_tidak_tetap' => 'nullable|numeric',
            'email' => 'nullable|email',
            'telp' => 'nullable|numeric',
            'alamat' => 'nullable',
            'provinces_id' => 'nullable',
            'regency_id' => 'nullable',
            'district_id' => 'nullable',
            'village_id' => 'nullable',
            'foto_usaha' => 'nullable|image',
        ];

        $messages = [
            'id_kumkm.numeric' => 'ID KUMKM Harus terisi angka',
            'nama_usaha.required' => 'Nama usaha tidak boleh kosong',
            'nama_pemilik.required' => 'Nama Pemilik tidak boleh kosong',
            'no_ktp.numeric' => 'No KTP harus terisi angka',
            'npwp.numeric' => 'NPWP harus terisi angka',
            'tk_tetap.numeric' => 'Harus terisi angka',
            'tk_tidak_tetap.numeric' => 'Harus terisi angka',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak benar',
            'telp.numeric' => 'No Telp Harus terisi angka',
            'foto_usaha.image' => 'Format foto tidak sesuai',
        ];
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return redirect('kumkm/' . $id)
                ->withInput()
                ->withErrors($validator);
        }

        $dataKumkm = $this->kumkm->getById($id);
        $oldfile = $dataKumkm->foto_usaha;

        if ($request->hasFile('foto_usaha')) {
            $file = Input::file('foto_usaha');
            $name = $this->upload_image($file, 'foto_usaha', $oldfile);
            $data['foto_usaha'] = $name;
        }

        $result = $this->kumkm->update($id, $data);
        if ($result) {
            return redirect('kumkm')->with('success', 'Berhasil ! Akun KUMKM telah berhasil diupdate');
        } else {
            return redirect('kumkm')->with('error', 'Maaf ! Terjadi kesalahan dalam sistem silhkan hubungi Administrator');
        }
    }

    public function detail($id)
    {
        $data = [
            'data' => $this->kumkm->getById($id),
            'title' => 'Tambah Data KUMKM Form 2/2',
        ];
        return view('kumkm.detail', $data);
    }

    public function doDetail(Request $request, $id)
    {
        $data = $request->all();

        $rules = [
            'kas_tunai' => 'nullable|numeric',
            'persediaan' => 'nullable|numeric',
            'harga_tetap' => 'nullable|numeric',
            'kw_bank' => 'nullable|numeric',
            'kw_koperasi' => 'nullable|numeric',
            'kw_lainnya' => 'nullable|numeric',
            'kp_sertifikat' => 'nullable|numeric',
            'kp_tidak_sertifikat' => 'nullable|numeric',
            'om_1thn_lalu' => 'nullable|numeric',
            'om_2thn_lalu' => 'nullable|numeric',
            'lb_1thn_lalu' => 'nullable|numeric',
            'lb_2thn_lalu' => 'nullable|numeric',
            'laporan_regular' => 'required',
            'p1_nama_produk' => 'required',
            'p1_deskripsi' => 'required',
            'p1_harga' => 'required|numeric',
            'p1_foto_produk' => 'nullable|image',
            'p2_nama_produk' => 'nullable',
            'p2_deskripsi' => 'nullable',
            'p2_harga' => 'nullable|numeric',
            'p2_foto_produk' => 'nullable|image',

            'p3_nama_produk' => 'nullable',
            'p3_deskripsi' => 'nullable',
            'p3_harga' => 'nullable|numeric',
            'p3_foto' => 'nullable|image',

            'izin_produk' => 'nullable',
            'izin_usaha_iumk' => 'nullable',
            'izin_usaha_siui' => 'nullable',
            'izin_usaha_siup' => 'nullable',
            'legalitas_lokasi' => 'nullable',
            'jangkauan_pasar' => 'nullable',
            'terima_pendampingan' => 'nullable',
            'masalah_lembaga' => 'nullable',
            'masalah_sdm' => 'nullable',
            'masalah_produksi' => 'nullable',
            'masalah_pembiayaan' => 'nullable',
            'masalah_pemasaran' => 'nullable',
            'masalah_lainnya' => 'nullable',
        ];

        $messages = [
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
        ];

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return redirect('kumkm/detail/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('p1_foto_produk')) {
            $file = Input::file('p1_foto_produk');
            $name = $this->upload_image($file, 'produk');
            $data['p1_foto_produk'] = $name;
        }

        if ($request->hasFile('p2_foto_produk')) {
            $file = Input::file('p2_foto_produk');
            $name = $this->upload_image($file, 'produk');
            $data['p2_foto_produk'] = $name;
        }

        if ($request->hasFile('p3_foto')) {
            $file = Input::file('p3_foto');
            $name = $this->upload_image($file, 'produk');
            $data['p3_foto'] = $name;
        }

        $result = $this->kumkm->update($id, $data);
        if ($result) {
            return redirect('kumkm')->with('success', 'Berhasil ! Akun KUMKM telah berhasil dibuat');
        } else {
            return redirect('kumkm')->with('error', 'Maaf ! Terjadi kesalahan dalam sistem silhkan hubungi Administrator');
        }
    }

    public function report()
    {
        $data = [
            'title' => 'Data Kumkm',
            'lembaga' => Cis_lembaga::all(),
            'kumkm' => Kumkm::with('lembaga', 'provinces', 'regencies', 'districts', 'villages', 'sentra_kumkm', 'bidangusaha')->paginate(10),
        ];
        return view('kumkm.report', $data);
    }

    public function delete($id)
    {
        $data = $this->kumkm->getById($id);
        $fotousaha = $data->foto_usaha;
        $produk1 = $data->p1_foto_produk;
        $produk2 = $data->p2_foto_produk;
        $produk3 = $data->p3_foto;
        $this->delete_image('produk', $fotousaha);
        $this->delete_image('produk', $produk1);
        $this->delete_image('produk', $produk2);
        $this->delete_image('produk', $produk3);

        $result = $this->kumkm->delete($id);
        if ($result) {
            return redirect('kumkm')->with('info', 'Data Bidang Layanan Berhasil Dihapus');
        }
    }

    public function show($id)
    {
        $data = [
            'title' => 'Data KMUMK',
            'data' => $this->kumkm->getById($id),
        ];
        return view('kumkm.show', $data);
    }

    public function printData($id)
    {
        $data = [
            'title' => 'Cetak KMUMK',
            'data' => $this->kumkm->getById($id),
        ];
        return view('kumkm.print', $data);
    }

    public function import()
    {
//        return $array = array(0 => "a", 1 => "b", 2 => "c");

        $data = [
            'title' => 'Import Data KUMKM',
        ];
        return view('kumkm.import', $data);
    }

    public function download($type)
    {
        $lembaga = \Request::input('lembaga');
        if ($lembaga != 'semua') {
            $datalembaga = Cis_lembaga::find($lembaga);
            $namefile = 'UMKM_MANAJEMEN_CIS_' . $datalembaga->plut_name;
            $datarow = \DB::table('kumkm')
                ->leftjoin('cis_lembagas', 'cis_lembagas.id', '=', 'kumkm.lembaga_id')
                ->leftjoin('bidang_usahas', 'bidang_usahas.id', '=', 'kumkm.bidang_usaha')
                ->leftjoin('sentra_kumkms', 'sentra_kumkms.id', '=', 'kumkm.sentra_id')
                ->leftjoin('provinces', 'provinces.id', '=', 'kumkm.provinces_id')
                ->leftjoin('regencies', 'regencies.id', '=', 'kumkm.regency_id')
                ->leftjoin('districts', 'districts.id', '=', 'kumkm.district_id')
                ->leftjoin('villages', 'villages.id', '=', 'kumkm.village_id')
                ->select(
                    'cis_lembagas.plut_name AS Nama_lembaga',
                    'kumkm.nama_usaha AS Nama_usaha',
                    'kumkm.nama_pemilik AS Nama_pemilik',
                    'kumkm.id_kumkm AS ID_KUMKM',
                    'kumkm.telp AS No_telp',
                    'kumkm.email AS Email',
                    'kumkm.badan_usaha AS Badan_usaha',
                    'kumkm.ket_badan_usaha AS Keterangan_badan_usaha',
                    'kumkm.tgl_mulai_usaha AS Tanggal_mulai_usaha',
                    'bidang_usahas.name AS Bidang_usaha',
                    'kumkm.skala_usaha AS Skala_usaha',
                    'kumkm.usaha_utama AS Usaha_utama',
                    'kumkm.hasil_produk AS Hasil_produk',
                    'kumkm.sentra AS Sentra',
                    'sentra_kumkms.name AS Sentra_kumkm',
                    'kumkm.tk_tetap AS Tenaga_kerja_tetap',
                    'kumkm.tk_tidak_tetap AS Tenaga_kerja_tidak_tetap',
                    'provinces.name AS Provinsi',
                    'regencies.name AS Kabupaten',
                    'districts.name AS Kecamatan',
                    'villages.name AS Kelurahan',
                    'kumkm.alamat AS Alamat',
                    'kumkm.kas_tunai AS Harga_Kas_tunai',
                    'kumkm.persediaan AS Harga_persediaan_bahan_baku',
                    'kumkm.harga_tetap AS Aset_harga_tetap',
                    'kumkm.kw_bank AS Kewajiban_pinjaman_bank',
                    'kumkm.kw_koperasi AS Kewajiban_pinjaman_koperasi',
                    'kumkm.kw_lainnya AS Kewajiban_pinjaman_lainnya',
                    'kumkm.kp_sertifikat AS Kepemilikan_tanah_SHM',
                    'kumkm.kp_tidak_sertifikat AS Kepemilikan_tanah_NONSHM',
                    'kumkm.om_1thn_lalu AS OMSET_1THN_LALU',
                    'kumkm.om_2thn_lalu AS OMSET_2THN_LALU',
                    'kumkm.lb_1thn_lalu AS LABA_1THN_LALU',
                    'kumkm.lb_2thn_lalu AS LABA_2THN_LALU',
                    'kumkm.laporan_regular AS Laporan_keuangan_secara_reguler',
                    'kumkm.p1_nama_produk AS Nama_produk_1',
                    'kumkm.p1_deskripsi AS Deskripsi_produk_1',
                    'kumkm.p1_harga AS Harga_produk_1',
                    'kumkm.p2_nama_produk AS Nama_produk_2',
                    'kumkm.p2_deskripsi AS Deskripsi_produk_2',
                    'kumkm.p2_harga AS Harga_produk_2',
                    'kumkm.izin_produk AS Izin_produk',
                    'kumkm.izin_usaha_iumk AS Izin_usaha_IUMK',
                    'kumkm.izin_usaha_siui AS Izin_usaha_SIUI',
                    'kumkm.izin_usaha_siup AS Izin_usaha_SIUP',
                    'kumkm.legalitas_lokasi AS Legalitas_lokasi',
                    'kumkm.jangkauan_pasar AS Jangkauan_pasar',
                    'kumkm.terima_pendampingan AS Terima_pendampingan',
                    'kumkm.masalah_lembaga',
                    'kumkm.masalah_sdm',
                    'kumkm.masalah_produksi',
                    'kumkm.masalah_pembiayaan',
                    'kumkm.masalah_pemasaran',
                    'kumkm.masalah_lainnya'
                )
                ->where('kumkm.lembaga_id', '=', $lembaga)
                ->get();
        } else {
            $namefile = 'UMKM_MANAJEMEN_CIS_SEMUA_LEMBAGA';
            $datarow = \DB::table('kumkm')
                ->leftjoin('cis_lembagas', 'cis_lembagas.id', '=', 'kumkm.lembaga_id')
                ->leftjoin('bidang_usahas', 'bidang_usahas.id', '=', 'kumkm.bidang_usaha')
                ->leftjoin('sentra_kumkms', 'sentra_kumkms.id', '=', 'kumkm.sentra_id')
                ->leftjoin('provinces', 'provinces.id', '=', 'kumkm.provinces_id')
                ->leftjoin('regencies', 'regencies.id', '=', 'kumkm.regency_id')
                ->leftjoin('districts', 'districts.id', '=', 'kumkm.district_id')
                ->leftjoin('villages', 'villages.id', '=', 'kumkm.village_id')
                ->select(
                    'cis_lembagas.plut_name AS Nama_lembaga',
                    'kumkm.nama_usaha AS Nama_usaha',
                    'kumkm.nama_pemilik AS Nama_pemilik',
                    'kumkm.id_kumkm AS ID_KUMKM',
                    'kumkm.telp AS No_telp',
                    'kumkm.email AS Email',
                    'kumkm.badan_usaha AS Badan_usaha',
                    'kumkm.ket_badan_usaha AS Keterangan_badan_usaha',
                    'kumkm.tgl_mulai_usaha AS Tanggal_mulai_usaha',
                    'bidang_usahas.name AS Bidang_usaha',
                    'kumkm.skala_usaha AS Skala_usaha',
                    'kumkm.usaha_utama AS Usaha_utama',
                    'kumkm.hasil_produk AS Hasil_produk',
                    'kumkm.sentra AS Sentra',
                    'sentra_kumkms.name AS Sentra_kumkm',
                    'kumkm.tk_tetap AS Tenaga_kerja_tetap',
                    'kumkm.tk_tidak_tetap AS Tenaga_kerja_tidak_tetap',
                    'provinces.name AS Provinsi',
                    'regencies.name AS Kabupaten',
                    'districts.name AS Kecamatan',
                    'villages.name AS Kelurahan',
                    'kumkm.alamat AS Alamat',
                    'kumkm.kas_tunai AS Harga_Kas_tunai',
                    'kumkm.persediaan AS Harga_persediaan_bahan_baku',
                    'kumkm.harga_tetap AS Aset_harga_tetap',
                    'kumkm.kw_bank AS Kewajiban_pinjaman_bank',
                    'kumkm.kw_koperasi AS Kewajiban_pinjaman_koperasi',
                    'kumkm.kw_lainnya AS Kewajiban_pinjaman_lainnya',
                    'kumkm.kp_sertifikat AS Kepemilikan_tanah_SHM',
                    'kumkm.kp_tidak_sertifikat AS Kepemilikan_tanah_NONSHM',
                    'kumkm.om_1thn_lalu AS OMSET_1THN_LALU',
                    'kumkm.om_2thn_lalu AS OMSET_2THN_LALU',
                    'kumkm.lb_1thn_lalu AS LABA_1THN_LALU',
                    'kumkm.lb_2thn_lalu AS LABA_2THN_LALU',
                    'kumkm.laporan_regular AS Laporan_keuangan_secara_reguler',
                    'kumkm.p1_nama_produk AS Nama_produk_1',
                    'kumkm.p1_deskripsi AS Deskripsi_produk_1',
                    'kumkm.p1_harga AS Harga_produk_1',
                    'kumkm.p2_nama_produk AS Nama_produk_2',
                    'kumkm.p2_deskripsi AS Deskripsi_produk_2',
                    'kumkm.p2_harga AS Harga_produk_2',
                    'kumkm.izin_produk AS Izin_produk',
                    'kumkm.izin_usaha_iumk AS Izin_usaha_IUMK',
                    'kumkm.izin_usaha_siui AS Izin_usaha_SIUI',
                    'kumkm.izin_usaha_siup AS Izin_usaha_SIUP',
                    'kumkm.legalitas_lokasi AS Legalitas_lokasi',
                    'kumkm.jangkauan_pasar AS Jangkauan_pasar',
                    'kumkm.terima_pendampingan AS Terima_pendampingan',
                    'kumkm.masalah_lembaga',
                    'kumkm.masalah_sdm',
                    'kumkm.masalah_produksi',
                    'kumkm.masalah_pembiayaan',
                    'kumkm.masalah_pemasaran',
                    'kumkm.masalah_lainnya'
                )
                ->get();
        }

        foreach ($datarow as $object) {
            $data[] = (array) $object;
        }
        if (isset($data) && count($data)) {
            return Excel::create($namefile, function ($excel) use ($data) {
                $excel->sheet('mySheet', function ($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->download($type);
        }

        return redirect('kumkm/report/all')->with('error', 'Maaf ! Data tidak ada');
    }

    public function doImport(Request $request)
    {
        $insertData = 0;
        $rules = [
            'file' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('kumkm/import/data')
                ->withErrors($validator)
                ->withInput();
        }

        if (Input::hasFile('file')) {
            $path = Input::file('file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            // return $data->count();

            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $kumkm = new Kumkm();
                    if ($value->lembaga_id != '') {
                        $kumkm->lembaga_id = $value->lembaga_id;
                    }

                    $kumkm->nama_usaha = $value->nama_usaha ? $value->nama_usaha : '-';

                    if ($value->nama_pemilik != '') {
                        $kumkm->nama_pemilik = $value->nama_pemilik;
                    }

                    if ($value->id_kumkm != '') {
                        $kumkm->id_kumkm = $value->id_kumkm;
                    }

                    if ($value->telp != '') {
                        $kumkm->telp = $value->telp;
                    }

                    if ($value->no_ktp != '') {
                        $kumkm->no_ktp = $value->no_ktp;
                    }

                    if ($value->npwp != '') {
                        $kumkm->npwp = $value->npwp;
                    }

                    if ($value->email != '') {
                        $kumkm->email = $value->email;
                    }

                    if ($value->badan_usaha != '') {
                        $kumkm->badan_usaha = $value->badan_usaha;
                    }

                    if ($value->ket_badan_usaha != '') {
                        $kumkm->ket_badan_usaha = $value->ket_badan_usaha;
                    }

                    if ($value->tgl_mulai_usaha != '') {
                        $kumkm->tgl_mulai_usaha = $value->tgl_mulai_usaha;
                    }

                    if ($value->bidang_usaha != '') {
                        $kumkm->bidang_usaha = $value->bidang_usaha;
                    }

                    if ($value->skala_usaha != '') {
                        $kumkm->skala_usaha = $value->skala_usaha;
                    }

                    if ($value->usaha_utama != '') {
                        $kumkm->usaha_utama = $value->usaha_utama;
                    }

                    if ($value->alamat != '') {
                        $kumkm->alamat = $value->alamat;
                    }

                    if ($value->tk_tetap != '') {
                        $kumkm->tk_tetap = $value->tk_tetap;
                    }

                    if ($value->tk_tidak_tetap != '') {
                        $kumkm->tk_tidak_tetap = $value->tk_tidak_tetap;
                    }

                    if ($value->kas_tunai != '') {
                        $kumkm->kas_tunai = $value->kas_tunai;
                    }

                    if ($value->persediaan != '') {
                        $kumkm->persediaan = $value->persediaan;
                    }

                    if ($value->harga_tetap != '') {
                        $kumkm->harga_tetap = $value->harga_tetap;
                    }

                    if ($value->kw_bank != '') {
                        $kumkm->kw_bank = $value->kw_bank;
                    }

                    if ($value->kw_koperasi != '') {
                        $kumkm->kw_koperasi = $value->kw_koperasi;
                    }

                    if ($value->kw_lainnya != '') {
                        $kumkm->kw_lainnya = $value->kw_lainnya;
                    }

                    if ($value->kp_sertifikat != '') {
                        $kumkm->kp_sertifikat = $value->kp_sertifikat;
                    }

                    if ($value->kp_tidak_sertifikat != '') {
                        $kumkm->kp_tidak_sertifikat = $value->kp_tidak_sertifikat;
                    }

                    if ($value->om_1thn_lau != '') {
                        $kumkm->om_1thn_lalu = $value->om_1thn_lau;
                    }

                    if ($value->om_2thn_lalu != '') {
                        $kumkm->om_2thn_lalu = $value->om_2thn_lalu;
                    }

                    if ($value->lb_1thn_lalu != '') {
                        $kumkm->lb_1thn_lalu = $value->lb_1thn_lalu;
                    }

                    if ($value->lb_2thn_lalu != '') {
                        $kumkm->lb_2thn_lalu = $value->lb_2thn_lalu;
                    }

                    if ($value->izin_produk != '') {
                        $kumkm->izin_produk = $value->izin_produk;
                    }

                    if ($value->izin_usaha_iumk != '') {
                        $kumkm->izin_usaha_iumk = $value->izin_usaha_iumk;
                    }

                    if ($value->izin_usaha_siui != '') {
                        $kumkm->izin_usaha_siui = $value->izin_usaha_siui;
                    }

                    if ($value->izin_usaha_siup != '') {
                        $kumkm->izin_usaha_siup = $value->izin_usaha_siup;
                    }

                    if ($value->legalitas_lokasi != '') {
                        $kumkm->legalitas_lokasi = $value->legalitas_lokasi;
                    }

                    if ($value->jangkauan_pasar != '') {
                        $kumkm->jangkauan_pasar = $value->jangkauan_pasar;
                    }

                    if ($value->terima_pendampingan != '') {
                        $kumkm->terima_pendampingan = $value->terima_pendampingan;
                    }

                    if ($value->masalah_lembaga != '') {
                        $kumkm->masalah_lembaga = $value->masalah_lembaga;
                    }

                    if ($value->masalah_sdm != '') {
                        $kumkm->masalah_sdm = $value->masalah_sdm;
                    }

                    if ($value->masalah_pembiayaan != '') {
                        $kumkm->masalah_pembiayaan = $value->masalah_pembiayaan;
                    }

                    if ($value->masalah_pemasaran != '') {
                        $kumkm->masalah_pemasaran = $value->masalah_pemasaran;
                    }

                    if ($value->masalah_lainnya != '') {
                        $kumkm->masalah_lainnya = $value->masalah_lainnya;
                    }

                    $kumkm->save();
                    if ($kumkm) {
                        $insertData++;
                    }
                }

                return redirect('kumkm')->with('success', 'Data berhasil masuk sebanyak ' . $insertData . ' Recorod');
            }

            return redirect('kumkm/import/data')->with('error', 'Data gagal masuk');
        }
    }
}
