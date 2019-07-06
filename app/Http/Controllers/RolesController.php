<?php

namespace App\Http\Controllers;

use App\Repositories\RolesRepository;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    protected $roles;

    public function __construct(RolesRepository $roles)
    {
        $this->roles = $roles;
    }

    public function getAll()
    {
        $data = Array
        (
            'title' => 'Daftar Role Hak Akses',
            'roles' => $this->roles->getAll()

        );
        return view('setting.roles.r_list',$data);
    }

    public function addData()
    {
        $data = Array
        (
            'title' => 'Tambah Tingkat',

        );
        return view('setting.roles.r_add',$data);
    }

    public function doAddData(Request $request)
    {
        $data = $request->all();
        $result = $this->roles->create($data);
        if($result)
        {
            return redirect('roles')->with('success','Data Tingkat Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = array(
            'title' => 'Edit Tingkat',
            'data' => $this->roles->getById($id)
        );
        return view('setting.roles.r_edit',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = $request->all();
        $result = $this->roles->update($id,$data);
        if($result)
        {
            return redirect('roles')->with('info','Data Tingkat Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->roles->delete($id);
        if($result)
        {
            return redirect('roles')->with('info','Data Tingkat Berhasil Dihapus');
        }
    }
}
