<?php

namespace App\Http\Controllers;

use App\Repositories\AdminLembagaRepository;
use App\Repositories\CisLembagaRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AdminLembagaController extends Controller
{
    protected $lembaga;
    protected $adminlembaga;
    protected $user;

    public function __construct(CisLembagaRepository $lembaga,
                                AdminLembagaRepository $adminlembaga, UserRepository $user)
    {
        $this->lembaga = $lembaga;
        $this->adminlembaga = $adminlembaga;
        $this->user = $user;
    }

    public function getAll()
    {
        $data = array(
            'head_title' => 'Admin',
            'title' => 'Data Admin Lembaga',
            'data' => $this->adminlembaga->getAll()
        );

        return view('admin_lembaga.list',$data);
    }

    public function addData()
    {
        $data = array(
            'head_title' => 'Admin',
            'title' => 'Tambah Admin Lembaga',
            'lembaga' => $this->lembaga->getAll()
        );

        return view('admin_lembaga.add',$data);
    }

    public function editData($id)
    {
        $data = array(
            'head_title' => 'Admin',
            'title' => 'Edit Admin Lembaga',
            'lembaga' => $this->lembaga->getAll(),
            'data' => $this->adminlembaga->getById($id)
        );

        return view('admin_lembaga.edit',$data);

    }

    public function doAddData(Request $request)
    {
        $data = $request->all();
        $result = $this->adminlembaga->create($data);
        if($result)
        {
            return redirect('admin')->with('success','Data Admin Lembaga Berhasil Disimpan');
        }
    }

    public function doEditData(Request $request,$id)
    {
        $data = $request->all();
        $result = $this->adminlembaga->update($id,$data);
        if($result)
        {
            return redirect('admin')->with('info','Data Admin Lembaga Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->adminlembaga->delete($id);
        if($result)
        {
            return redirect('admin')->with('info','Data Admin Lembaga Berhasil Dihapus');
        }
    }
}
