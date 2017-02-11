<?php

namespace App\Http\Controllers;

use App\Http\Traits\UploadTrait;
use App\Repositories\CisLembagaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CisLembagaController extends Controller
{
    use UploadTrait;
    protected $cislembaga;

    public function __construct(CisLembagaRepository $cisLembagaRepository)
    {
        $this->cislembaga = $cisLembagaRepository;
    }

    public function getAll()
    {
        $data = Array
        (
            'head_title' => 'CIS PLUT-KUMKM',
            'title' => 'Data CIS PLUT-KUMKM',
            'data' => $this->cislembaga->getAll()
        );

        return view('cislembaga.list',$data);
    }

    public function getAllColumn()
    {
        $data = Array
        (
            'head_title' => 'CIS PLUT-KUMKM',
            'title' => 'Report CIS PLUT-KUMKM',
            'data' => $this->cislembaga->getAll()
        );

        return view('cislembaga.report',$data);
    }

    public function detailData($id)
    {
        $data = Array
        (
            'head_title' => 'CIS PLUT-KUMKM',
            'title' => 'Detail CIS PLUT-KUMKM',
            'data' => $this->cislembaga->getById($id)
        );

        return view('cislembaga.detail',$data);
    }

    public function addData()
    {
        $data = Array
        (
            'head_title' => 'CIS PLUT-KUMKM',
            'title' => 'Tambah CIS PLUT-KUMKM',
        );

        return view('cislembaga.add',$data);
    }

    public function editData($id)
    {
        $data = Array
        (
            'head_title' => 'CIS PLUT-KUMKM',
            'title' => 'Edit CIS PLUT-KUMKM',
            'data' => $this->cislembaga->getById($id)
        );

        return view('cislembaga.edit',$data);
    }

    public function doAddData(Request $request)
    {
        $data = $request->all();
        if($request->hasFile('photo_gedung'))
        {
            $file = Input::file('photo_gedung');
            $name = $this->upload_image($file,'images');
            $data['photo_gedung'] = $name;
        }
        $result = $this->cislembaga->create($data);
        if($result)
        {
            return redirect('cislembaga')->with('success','Data CIS PLUT-KUMKM Berhasil Disimpan');
        }
    }

    public function doEditData(Request $request,$id)
    {
        $data = $request->all();
        $cislembaga = $this->cislembaga->getById($id);
        $oldfile = $cislembaga->photo_gedung;

        if($request->hasFile('photo_gedung'))
        {
            $file = Input::file('photo_gedung');
            $name = $this->upload_image($file,'images',$oldfile);
            $data['photo_gedung'] = $name;
        }
        $result = $this->cislembaga->update($id,$data);
        if($result)
        {
            return redirect('cislembaga')->with('info','Data CIS PLUT-KUMKM Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->cislembaga->delete($id);
        if($result)
        {
            return redirect('cislembaga')->with('info','Data CIS PLUT-KUMKM Berhasil Diupdate');
        }
    }
}
