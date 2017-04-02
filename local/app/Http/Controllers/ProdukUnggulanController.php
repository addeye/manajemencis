<?php

namespace App\Http\Controllers;

use App\Repositories\ProdukUnggulanRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukUnggulanController extends Controller
{
    protected $produk;

    public function __construct(ProdukUnggulanRepository $produkUnggulanRepository)
    {
        $this->produk = $produkUnggulanRepository;
    }

    public function getAll()
    {
        $data = Array
        (
            'head_title' => 'Data Produk Unggulan',
            'title' => 'Data Bidang Layanan',
            'produk' => $this->produk->getAll()

        );

        return view('produk_unggulan.list',$data);
    }

    public function add()
    {
        $data = Array
        (
            'title' => 'Tambah Produk Unggulan',

        );
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
            'kapasitas_perbulan'    => 'nullable',
            'omset_perbulan'        => 'nullable',
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
            'nama_perusahaan.required' => 'Nama perusahaann haruss terisi',
            'alamat.required'       =>'Alamat harus terisi',
            'provinces_id.required' => 'Provinsi harus terisi',
            'regency_id.required'   => 'Kabupaten kota harus terisi',
            'telp.numeric'          => 'Telepon harus angka',
            'email.email'           => 'Email anda harus benar',
        );

        $validator = Validator::make($data,$rules,$messages);
        if($validator->fails())
        {
            return redirect('produk_unggulan/create')
                ->withErrors($validator)
                ->withInput();
        }

        $result = $this->produk->create($data);
        if($result)
        {
            return redirect('produk_unggulan')->with('success','Data Bidang Layanan Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = array(
            'title' => 'Edit Bidang Layanan',
            'data' => $this->produk->getById($id)
        );
        return view('bidang_layanan.edit_bidang_layanan',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = array(
            'name'=>$request->name
        );
        $result = $this->produk->update($id,$data);
        if($result)
        {
            return redirect('bidanglayanan')->with('info','Data Bidang Layanan Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->produk->delete($id);
        if($result)
        {
            return redirect('bidanglayanan')->with('info','Data Bidang Layanan Berhasil Dihapus');
        }
    }
}
