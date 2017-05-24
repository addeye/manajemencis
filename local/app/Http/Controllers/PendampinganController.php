<?php

namespace App\Http\Controllers;

use App\Repositories\KumkmRepository;
use App\Repositories\PendampinganRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PendampinganController extends Controller
{
    protected $pendampingan;
    protected $kumkm;

    public function __construct(PendampinganRepository $pendampinganRepository, KumkmRepository $kumkmRepository)
    {
        $this->pendampingan = $pendampinganRepository;
        $this->kumkm = $kumkmRepository;
    }

    public function getAll()
    {
        $data = array(
            'title' => 'Data Pendampingan KUMKM',
            'pendampingan' => $this->pendampingan->getAll()
        );

        return view('pendampingan.list',$data);
    }

    public function getAllReport()
    {
        $data = array(
            'title' => 'Laporan Pendampingan KUMKM',
            'pendampingan' => $this->pendampingan->getAll()
        );
        return view('pendampingan.report',$data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Tambah Pendampingan KUMKM',
            'kumkm' => $this->kumkm->getAll()
        );

        return view('pendampingan.add',$data);
    }

    public function doAdd(Request $request)
    {
        $data = $request->all();

        $rules = [
            'kumkm_id' => 'required',
            'tanggal_pendampingan' => 'required',
            'permasalahan' => 'required',
            'saran_tindakan' => 'required',
            'tindak_lanjut' => 'required'
        ];

        $messages = [
            'kumkm_id.required' => 'Kumkm harus dipilih Jika tidak ada silahkan isi terlebih dahulu',
            'tanggal_pendampingan.required' => 'Tanggal harus terisi',
            'permasalahan.required' => 'Permasalahan Harus terisi',
            'saran_tindakan.required' => 'Saran / Tindakan Harus terisi',
            'tindak_lanjut.required' => 'Tindak lanjut harus terisi'
        ];

        $validator = Validator::make($data,$rules,$messages);
        if($validator->fails())
        {
            return redirect('pendampingan/create')
                ->withInput()
                ->withErrors($validator);
        }

        $data['user_id'] = Auth::user()->id;

        $result = $this->pendampingan->create($data);
        if($result)
        {
            return redirect('pendampingan')->with('success','Data pendampingan Berhasil Disimpan');
        }
    }

    public function edit($id)
    {
        $data = array(
            'title' => 'Edit Pendampingan KUMKM',
            'kumkm' => $this->kumkm->getAll(),
            'data' => $this->pendampingan->getById($id)
        );
        return view('pendampingan.edit',$data);
    }

    public function doEdit(Request $request,$id)
    {
        $data = $request->all();

        $rules = [
            'kumkm_id' => 'required',
            'tanggal_pendampingan' => 'required',
            'permasalahan' => 'required',
            'saran_tindakan' => 'required',
            'tindak_lanjut' => 'required'
        ];

        $messages = [
            'kumkm_id.required' => 'Kumkm harus dipilih Jika tidak ada silahkan isi terlebih dahulu',
            'tanggal_pendampingan.required' => 'Tanggal harus terisi',
            'permasalahan.required' => 'Permasalahan Harus terisi',
            'saran_tindakan.required' => 'Saran / Tindakan Harus terisi',
            'tindak_lanjut.required' => 'Tindak lanjut harus terisi'
        ];

        $validator = Validator::make($data,$rules,$messages);
        if($validator->fails())
        {
            return redirect('pendampingan/'.$id)
                ->withInput()
                ->withErrors($validator);
        }
        $result = $this->pendampingan->update($id,$data);
        if($result)
        {
            return redirect('pendampingan')->with('info','Data pendampingan Berhasil Diupdate');
        }
    }

    public function delete()
    {

    }
}
