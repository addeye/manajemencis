<?php

namespace App\Http\Controllers;

use App\Mail\KonsultasiOnline;
use App\Repositories\BidangLayananRepository;
use App\Repositories\KonsultasiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class KonsultasiController extends Controller
{
    protected $konsultasi;
    protected $bidanglayanan;

    public function __construct(KonsultasiRepository $konsultasiRepository,
                                BidangLayananRepository $bidangLayananRepository)
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
            return redirect('konsultasi')->with('success','Terima kasih ! Informasi selanjutnya cek melalui Email anda');
        }
        else
        {
            return redirect('konsultasi')->with('error','Maaf ! Terjadi kesalahan dalam sistem silhkan hubungi Administrator');
        }
    }

    public function detail($id)
    {
        $data=array(
            'user' => Auth::user(),
            'data' => $this->konsultasi->getById($id)
        );

        return view('konsultasi.detail',$data);
    }

    public function doEdit(Request $request,$id)
    {
        $data = $request->all();
        $rules = [
            'respon' => 'required'
        ];
        $messages = [
            'respon.required' => 'Respon tidak boleh kosong...'
        ];

        $validator = Validator::make($data,$rules,$messages);
        if($validator->fails())
        {
            return redirect('konsultasi/'.$id.'/detail')
                ->withErrors($validator)
                ->withInput();
        }

        if(Auth::user()->role_id==1)
        {
            return redirect('konsultasi/'.$id.'/detail')->with('error','Anda tidak boleh sebagai Admin Nasional');
        }

        if(Auth::user()->role_id==2)
        {
            $lembaga_id = Auth::user()->adminlembagas->lembaga_id;
        }
        elseif(Auth::user()->role_id==3)
        {
            $lembaga_id = Auth::user()->konsultans->lembaga_id;
        }

        $data=[
            'lembaga_id' => $lembaga_id,
            'user_id' => Auth::user()->id,
            'respon' => $request->respon
        ];

        $konsultasiRow = $this->konsultasi->getById($id);

        $result = $this->konsultasi->update($id,$data);
        if($result)
        {
            Mail::to($konsultasiRow->email)->send(new KonsultasiOnline($id,Auth::user()->id));

            return redirect('konsultasi/'.$id.'/detail')->with('success','Respon anda berhasil terkirim');
        }
        else
        {
            return redirect('konsultasi/'.$id.'/detail')->with('error','Terjadi kesalahan sistem silahkan hubungi Administrator');
        }
    }
}
