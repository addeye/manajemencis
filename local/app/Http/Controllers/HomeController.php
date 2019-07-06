<?php

namespace App\Http\Controllers;

use App\Http\Traits\UploadTrait;
use App\Koperasi;
use App\Kumkm;
use App\PelaksanaanPendampingan;
use App\ProgramKerja;
use App\Repositories\AdminLembagaRepository;
use App\Repositories\DetailsProkersRepository;
use App\Repositories\InformasiPasarRepository;
use App\Repositories\KegiatanKonsultanRepository;
use App\Repositories\KonsultanRepository;
use App\Repositories\KonsultasiRepository;
use App\Repositories\PengumumanRepository;
use App\Repositories\ProkerKonsultanRepository;
use App\Repositories\SentraKumkmRepository;
use App\Repositories\UserRepository;
use App\SasaranProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\ActivityLog;

class HomeController extends Controller
{
    use UploadTrait;
    protected $user;
    protected $sentra;
    protected $proker;
    protected $konsultan;
    protected $adminlembaga;
    protected $kegiatan;
    protected $detailProker;
    protected $pengumuman;
    protected $konsultasi;
    protected $informasi;

    public function __construct(
        UserRepository $user,
        SentraKumkmRepository $sentraKumkmRepository,
        ProkerKonsultanRepository $prokerKonsultanRepository,
        KonsultanRepository $konsultanRepository,
        AdminLembagaRepository $adminLembagaRepository,
        KegiatanKonsultanRepository $kegiatanKonsultanRepository,
        DetailsProkersRepository $detailsProkersRepository,
        PengumumanRepository $pengumumanRepository,
        KonsultasiRepository $konsultasiRepository,
        InformasiPasarRepository $informasiPasarRepository
    ) {
        $this->user = $user;
        $this->sentra = $sentraKumkmRepository;
        $this->proker = $prokerKonsultanRepository;
        $this->konsultan = $konsultanRepository;
        $this->adminlembaga = $adminLembagaRepository;
        $this->kegiatan = $kegiatanKonsultanRepository;
        $this->detailProker = $detailsProkersRepository;
        $this->pengumuman = $pengumumanRepository;
        $this->konsultasi = $konsultasiRepository;
        $this->informasi = $informasiPasarRepository;
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role_id == 2 or $user->role_id == 5) {
            if ($user->role_id == 2) {
                $lembaga_id = $user->adminlembagas->lembaga_id;
            } elseif ($user->role_id == 5) {
                $lembaga_id = $user->pengelolah->lembaga_id;
            }

            $data = [
                'jml_kumkm' => Kumkm::where('lembaga_id', $lembaga_id)->count(),
                'jml_koperasi' => Koperasi::where('lembaga_id', $lembaga_id)->count(),
                'koperasi_dampingan' => SasaranProgram::where('ukmtable_type', 'koperasi')->where('lembaga_id', $lembaga_id)->count(),
                'umkm_dampingan' => SasaranProgram::where('ukmtable_type', 'kumkm')->where('lembaga_id', $lembaga_id)->count(),
                'program' => ProgramKerja::where('lembaga_id', $lembaga_id)->count(),
                'pelaksanaan' => PelaksanaanPendampingan::where('lembaga_id', $lembaga_id)->count(),
                'pengumuman' => $this->pengumuman->getAll(),
                'konsultasi' => $this->konsultasi->getAll(),
                'informasi' => $this->informasi->getAll(),
            ];
        } elseif ($user->role_id == 3) {
            $lembaga_id = $user->konsultans->lembaga_id;

            $data = [
                'jml_kumkm' => Kumkm::where('lembaga_id', $lembaga_id)->count(),
                'jml_koperasi' => Koperasi::where('lembaga_id', $lembaga_id)->count(),
                'koperasi_dampingan' => SasaranProgram::where('ukmtable_type', 'koperasi')->where('lembaga_id', $lembaga_id)->count(),
                'umkm_dampingan' => SasaranProgram::where('ukmtable_type', 'kumkm')->where('lembaga_id', $lembaga_id)->count(),
                'program' => ProgramKerja::where('lembaga_id', $lembaga_id)->count(),
                'pelaksanaan' => PelaksanaanPendampingan::where('lembaga_id', $lembaga_id)->count(),
                'pengumuman' => $this->pengumuman->getAll(),
                'konsultasi' => $this->konsultasi->getAll(),
                'informasi' => $this->informasi->getAll(),
            ];
        } elseif ($user->role_id == 1 or $user->role_id == 6) {
            $data = [
                'jml_kumkm' => Kumkm::count(),
                'jml_koperasi' => Koperasi::count(),
                'koperasi_dampingan' => SasaranProgram::where('ukmtable_type', 'koperasi')->count(),
                'umkm_dampingan' => SasaranProgram::where('ukmtable_type', 'kumkm')->count(),
                'program' => ProgramKerja::count(),
                'pelaksanaan' => PelaksanaanPendampingan::count(),
                'pengumuman' => $this->pengumuman->getAll(),
                'konsultasi' => $this->konsultasi->getAll(),
                'informasi' => $this->informasi->getAll(),
            ];
        }
        $data['activity'] = ActivityLog::with('user')->whereHas('user', function ($q) {$q->where('role_id', '!=', 1);})->orderBy('created_at', 'DESC')->paginate();
        // return $data;
        if ($user->role_id == 1) {
            return view('home', $data);
        } elseif ($user->role_id == 2) {
            return view('dashboard.admin.home', $data);
        } elseif ($user->role_id == 3) {
            return view('dashboard.konsultan.home', $data);
        } elseif ($user->role_id == 4) {
        } elseif ($user->role_id == 5) {
            return view('dashboard.pengelolah.home', $data);
        } elseif ($user->role_id == 6) {
            return view('dashboard.monev.home', $data);
        }
        return view('home', $data);
    }

    public function profile()
    {
        $data = [
            'data' => Auth::user(),
        ];
        return view('profile', $data);
    }

    public function doProfile(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'images' => 'image|max:1024',
        ]);
        if ($validator->fails()) {
            return redirect('profile')
                ->withErrors($validator)
                ->withInput();
        }
        $user_data = $this->user->getById($id);
        $oldfile = $user_data->path;
        if ($request->hasFile('images')) {
            $files = Input::file('images');
            //getting timestamp
            $name = $this->upload_image($files, 'images', $oldfile);
            $data['path'] = $name;
        }
        $result = $this->user->update($id, $data);

        if (Auth::user()->role_id == 2) {
            $datakonsultan = [
                'nama_lengkap' => $request->name,
                'email' => $request->email,
            ];
            $this->konsultan->updateByUser($id, $datakonsultan);
        } elseif (Auth::user()->role_id == 3) {
            $dataadmin = [
                'nama_lengkap' => $request->name,
                'email' => $request->email,
            ];
            $this->adminlembaga->updateByUser($id, $dataadmin);
        }

        if ($result) {
            return redirect('profile')->with('info', 'Data User Berhasil Dirubah');
        }
    }
}
