<?php

namespace App\Http\Controllers;

use App\Repositories\TingkatsRepository;
use Illuminate\Http\Request;

class TingkatsController extends Controller
{
    protected $tingkat;

    public function __construct(TingkatsRepository $tingkat)
    {
        $this->tingkat = $tingkat;
    }

    public function getAll()
    {
        $data = Array
        (
            'title' => 'Data Tingkat',
            'tingkat' => $this->tingkat->getAll()

        );
        return view('setting.tingkat.t_list',$data);
    }

    public function addData()
    {
        $data = Array
        (
            'title' => 'Tambah Tingkat',

        );
        return view('setting.tingkat.t_add',$data);
    }

    public function doAddData(Request $request)
    {
        $data = $request->all();
        $result = $this->tingkat->create($data);
        if($result)
        {
            return redirect('tingkat')->with('success','Data Tingkat Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = array(
            'title' => 'Edit Tingkat',
            'data' => $this->tingkat->getById($id)
        );
        return view('setting.tingkat.t_edit',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = $request->all();
        $result = $this->tingkat->update($id,$data);
        if($result)
        {
            return redirect('tingkat')->with('info','Data Tingkat Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->tingkat->delete($id);
        if($result)
        {
            return redirect('tingkat')->with('info','Data Tingkat Berhasil Dihapus');
        }
    }
}
