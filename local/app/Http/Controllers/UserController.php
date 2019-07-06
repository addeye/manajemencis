<?php

namespace App\Http\Controllers;

use App\Repositories\RolesRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $user;
    protected $roles;

    public function __construct(UserRepository $user, RolesRepository $roles)
    {
        $this->user = $user;
        $this->roles = $roles;
    }

    public function getAll()
    {
        $data = [
            'title' => 'Data User',
            'user' => $this->user->getAll()
        ];
        return view('setting.users.u_list', $data);
    }

    public function addData()
    {
        $data = [
            'title' => 'Tambah User',
            'roles' => $this->roles->getAll()
        ];
        return view('setting.users.u_add', $data);
    }

    public function doAddData(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role_id' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return redirect('u/create')
                ->withErrors($validator)
                ->withInput();
        }

//        return $data;
        $result = $this->user->create($data);
        if ($result) {
            return redirect('u')->with('success', 'Data Bidang Layanan Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = [
            'title' => 'Edit User',
            'roles' => $this->roles->getAll(),
            'data' => $this->user->getById($id)
        ];
        return view('setting.users.u_edit', $data);
    }

    public function doEditData(Request $request, $id)
    {
        $data = $request->all();

        $result = $this->user->update($id, $data);
        if ($result) {
            return redirect('u')->with('info', 'Data User Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->user->delete($id);
        if ($result) {
            return redirect('u')->with('info', 'Data User Berhasil Dihapus');
        }
    }
}
