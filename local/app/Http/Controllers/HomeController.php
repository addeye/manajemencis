<?php
namespace App\Http\Controllers;
use App\Http\Traits\UploadTrait;
use App\Repositories\AdminLembagaRepository;
use App\Repositories\DetailsProkersRepository;
use App\Repositories\KegiatanKonsultanRepository;
use App\Repositories\KonsultanRepository;
use App\Repositories\ProkerKonsultanRepository;
use App\Repositories\SentraKumkmRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
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

    public function __construct(UserRepository $user,
                                SentraKumkmRepository $sentraKumkmRepository,
                                ProkerKonsultanRepository $prokerKonsultanRepository,
                                KonsultanRepository $konsultanRepository,
                                AdminLembagaRepository $adminLembagaRepository,
                                KegiatanKonsultanRepository $kegiatanKonsultanRepository,
                                DetailsProkersRepository $detailsProkersRepository)
    {
        $this->user = $user;
        $this->sentra = $sentraKumkmRepository;
        $this->proker = $prokerKonsultanRepository;
        $this->konsultan = $konsultanRepository;
        $this->adminlembaga = $adminLembagaRepository;
        $this->kegiatan = $kegiatanKonsultanRepository;
        $this->detailProker = $detailsProkersRepository;
    }
    public function index()
    {
        $data=array
        (
            'jml_sentra' => count($this->sentra->getAll()),
            'jml_proker' => count($this->proker->getAll()),
            'jml_kegiatan' => count($this->kegiatan->getAll()),
            'jml_penerima' => $this->kegiatan->jmlPesertaKegiatan(),
        );
        return view('home',$data);

    }
    public function profile()
    {
        $data=array(
            'data' => Auth::user()
        );
        return view('profile',$data);
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
        if($request->hasFile('images'))
        {
            $files = Input::file('images');
            //getting timestamp
            $name = $this->upload_image($files,'images',$oldfile);
            $data['path'] = $name;
        }
        $result = $this->user->update($id,$data);

        if (Auth::user()->role_id == 2)
        {
            $datakonsultan=array(
                'nama_lengkap' => $request->name,
                'email' => $request->email
            );
            $this->konsultan->updateByUser($id,$datakonsultan);
        }
        elseif (Auth::user()->role_id == 3)
        {
            $dataadmin = array(
                'nama_lengkap' => $request->name,
                'email' => $request->email
            );
            $this->adminlembaga->updateByUser($id,$dataadmin);
        }

        if($result)
        {
            return redirect('profile')->with('info','Data User Berhasil Dirubah');
        }
    }
}