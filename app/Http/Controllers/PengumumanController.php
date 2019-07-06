<?php

namespace App\Http\Controllers;

use App\Repositories\PengumumanRepository;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    protected $pengumuman;

    public function __construct(PengumumanRepository $pengumumanRepository)
    {
        $this->pengumuman = $pengumumanRepository;
    }

    public function index()
    {
        $data=array(
            'title' => 'Pengumuman',
            'pengumuman' => $this->pengumuman->getAll()
        );

        return view('pengumuman.list',$data);
    }

    public function add()
    {
        $data=array(
            'title' => 'Buat Pengumuman Baru'
        );

        return view('pengumuman.add',$data);
    }

    public function doAdd(Request $request)
    {
        $data = $request->all();
        $result = $this->pengumuman->create($data);
        if($result)
        {
            return redirect('pengumuman')->with('success','Pengumuman berhasil ditambahkan');
        }
    }

    public function edit($id)
    {
        $data=array(
            'title' => 'Edit Pengumuman',
            'data' => $this->pengumuman->getById($id)
        );

        return view('pengumuman.edit',$data);
    }

    public function doEdit(Request $request,$id)
    {
        $data = $request->all();
        $result = $this->pengumuman->update($id,$data);
        if($result)
        {
            return redirect('pengumuman')->with('info','Pengumuman berhasil diupdate');
        }
    }

    public function destroy($id)
    {
        $result = $this->pengumuman->delete($id);
        if($result)
        {
            return redirect('pengumuman')->with('info','Pengumuman berhasil dihapus');
        }
    }

}
