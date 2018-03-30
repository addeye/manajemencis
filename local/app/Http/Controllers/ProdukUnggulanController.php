<?php

namespace App\Http\Controllers;

use App\Repositories\BidangUsahaRepository;
use App\Repositories\ProdukUnggulanRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use App\Repositories\SentraKumkmRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProdukUnggulanController extends Controller
{
    protected $produk;
    protected $provinces;
    protected $regencies;
    protected $bidangUsaha;
    protected $sentra;

    public function __construct(ProdukUnggulanRepository $produkUnggulanRepository,
                                ProvincesRepository $provincesRepository,
                                RegenciesRepository $regenciesRepository,
                                BidangUsahaRepository $bidangUsahaRepository, SentraKumkmRepository $sentraKumkmRepository)
    {
        $this->produk = $produkUnggulanRepository;
        $this->provinces = $provincesRepository;
        $this->regencies = $regenciesRepository;
        $this->bidangUsaha = $bidangUsahaRepository;
        $this->sentra = $sentraKumkmRepository;
    }

    public function getAll()
    {
        $data = Array
        (
            'head_title' => 'Data Produk Unggulan',
            'title' => 'Data Produk Unggulan',
            'produk' => $this->produk->getAll()
        );
        

        return view('produk_unggulan.list',$data);
    }

    public function getAllReport()
    {
        $data = Array
        (
            'head_title' => 'Laporan Produk Unggulan',
            'title' => 'Laporan Produk Unggulan',
            'produk' => $this->produk->getAll()

        );

        return view('produk_unggulan.report',$data);
    }

    public function add()
    {
        $data = Array
        (
            'title' => 'Tambah Produk Unggulan',
            'provinces' => $this->provinces->getAll(),
            'bidang_usaha' => $this->bidangUsaha->getAll()
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
        return view('produk_unggulan.add',$data);
    }

    public function doAdd(Request $request)
    {
        $data = $request->all();
        $rules = array(
            'nama_produk'           => 'required',
            'merek'                 => 'nullable',
            'bidang_usaha'          => 'required',
            'satuan'                => 'nullable',
            'kapasitas_perbulan'    => 'required|numeric',
            'omset_perbulan'        => 'required|numeric',
            'nama_pemilik'          => 'required',
            'nama_perusahaan'       => 'required',
            'alamat'                => 'required',
            'provinces_id'          => 'required',
            'regency_id'            => 'required',
            'telp'                  => 'nullable|numeric',
            'email'                 => 'nullable|email',
            'sentra'                => 'nullable',
            'sentra_id'             => 'nullable',
            'legalitas'             => 'nullable'
        );
        $messages = array(
            'nama_produk.required' => 'Nama produk harus terisi',
            'bidang_usaha.required' => 'Bidang usaha harus dipilih',
            'nama_pemilik.required'  => 'Nama pemilik harus terisi',
            'nama_perusahaan.required' => 'Nama perusahaann harus terisi',
            'alamat.required'       =>'Alamat harus terisi',
            'provinces_id.required' => 'Provinsi harus terisi',
            'regency_id.required'   => 'Kabupaten kota harus terisi',
            'telp.numeric'          => 'Telepon harus angka',
            'email.email'           => 'Email anda harus benar',
            'kapasitas_perbulan.required' => 'Kapasitas perbulan harus terisi',
            'kapasitas_perbulan.numeric' => 'Harus terisi dengan angka',
            'omset_perbulan.required' => 'Omset Perbulan harus terisi',
            'omset_perbulan.numeric' => 'Harus terisi dengan angka',
        );

        $validator = Validator::make($data,$rules,$messages);
        if($validator->fails())
        {
            return redirect('produk_unggulan/create')
                ->withInput()
                ->withErrors($validator);
        }

        if($request->sentra_id=='')
        {
            $data['sentra_id'] = 0;
        }

        $user = Auth::user();

        if(!$request->has('lembaga_id'))
        {
            if($user->role_id ==3)
            {
                $data['lembaga_id'] = $user->konsultans->lembaga_id;
            }
            elseif ($user->role_id ==2) 
            {
                $data['lembaga_id'] = $user->adminlembagas->lembaga_id;
            }
        }

        $result = $this->produk->create($data);
        if($result)
        {
            return redirect('produk_unggulan')->with('success','Produk Unggulan Berhasil Disimpan');
        }
    }

    public function edit($id)
    {
        $rowProduk = $this->produk->getById($id);
        $data = array(
            'title' => 'Edit Bidang Layanan',
            'provinces' => $this->provinces->getAll(),
            'regencies' => $this->regencies->getByProvinces($rowProduk->provinces_id),
            'bidang_usaha' => $this->bidangUsaha->getAll(),
            'data' => $rowProduk
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
        return view('produk_unggulan.edit',$data);
    }

    public function doEdit(Request $request,$id)
    {
        $data = $request->all();
        $rules = array(
            'nama_produk'           => 'required',
            'merek'                 => 'nullable',
            'bidang_usaha'          => 'required',
            'satuan'                => 'nullable',
            'kapasitas_perbulan'    => 'required|numeric',
            'omset_perbulan'        => 'required|numeric',
            'nama_pemilik'          => 'required',
            'nama_perusahaan'       => 'required',
            'alamat'                => 'required',
            'provinces_id'          => 'required',
            'regency_id'            => 'required',
            'telp'                  => 'nullable|numeric',
            'email'                 => 'nullable|email',
            'sentra'                => 'nullable',
            'sentra_id'             => 'nullable',
            'legalitas'             => 'nullable'
        );
        $messages = array(
            'nama_produk.required' => 'Nama produk harus terisi',
            'bidang_usaha.required' => 'Bidang usaha harus dipilih',
            'nama_pemilik.required'  => 'Nama pemilik harus terisi',
            'nama_perusahaan.required' => 'Nama perusahaann harus terisi',
            'alamat.required'       =>'Alamat harus terisi',
            'provinces_id.required' => 'Provinsi harus terisi',
            'regency_id.required'   => 'Kabupaten kota harus terisi',
            'telp.numeric'          => 'Telepon harus angka',
            'email.email'           => 'Email anda harus benar',
            'kapasitas_perbulan.required' => 'Kapasitas perbulan harus terisi',
            'kapasitas_perbulan.numeric' => 'Harus terisi dengan angka',
            'omset_perbulan.required' => 'Omset Perbulan harus terisi',
            'omset_perbulan.numeric' => 'Harus terisi dengan angka',
        );
        if($request->sentra_id=='')
        {
            $data['sentra_id'] = 0;
        }
        $validator = Validator::make($data,$rules,$messages);
        if($validator->fails())
        {
            return redirect('produk_unggulan/'.$id)
                ->withInput()
                ->withErrors($validator);
        }
        $result = $this->produk->update($id,$data);
        if($result)
        {
            return redirect('produk_unggulan')->with('info','Produk Unggulan Berhasil Diupdate');
        }
    }

    public function delete($id)
    {
        $result = $this->produk->delete($id);
        if($result)
        {
            return redirect('produk_unggulan')->with('info','Produk Unggulan Berhasil Dihapus');
        }
    }
}
