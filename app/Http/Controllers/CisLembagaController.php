<?php

namespace App\Http\Controllers;

use App\Http\Traits\UploadTrait;
use App\Repositories\CisLembagaRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CisLembagaController extends Controller
{
    use UploadTrait;
    protected $cislembaga;
    protected $provinces;
    protected $regencies;

    public function __construct(
        CisLembagaRepository $cisLembagaRepository,
        ProvincesRepository $provincesRepository,
        RegenciesRepository $regenciesRepository
    ) {
        $this->cislembaga = $cisLembagaRepository;
        $this->provinces = $provincesRepository;
        $this->regencies = $regenciesRepository;
    }

    public function getAll()
    {
        $data = [
            'head_title' => 'Lembaga',
            'title' => 'Data Lembaga',
            'data' => $this->cislembaga->getAll(),
        ];

        return view('cislembaga.list', $data);
    }

    public function getAllColumn()
    {
        $data = [
            'head_title' => 'Lembaga',
            'title' => 'Report Lembaga',
            'data' => $this->cislembaga->getAll(),
        ];

        return view('cislembaga.report', $data);
    }

    public function detailData($id)
    {
        $data = [
            'head_title' => 'Lembaga',
            'title' => 'Detail Lembaga',
            'data' => $this->cislembaga->getById($id),
        ];

        return view('cislembaga.detail', $data);
    }

    public function addData()
    {
        $data = [
            'head_title' => 'Lembaga',
            'title' => 'Tambah Lembaga',
            'provinces' => $this->provinces->getAll(),
        ];

        return view('cislembaga.add', $data);
    }

    public function editData($id)
    {
        $rowdata = $this->cislembaga->getById($id);
        $data = [
            'head_title' => 'Lembaga',
            'title' => 'Edit Lembaga',
            'provinces' => $this->provinces->getAll(),
            'data' => $rowdata,
            'regencies' => $this->regencies->getByProvinces($rowdata->provinces_id),
        ];

        return view('cislembaga.edit', $data);
    }

    public function doAddData(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo_gedung')) {
            $file = Input::file('photo_gedung');
            $name = $this->upload_image($file, 'images');
            $data['photo_gedung'] = $name;
        }
        $result = $this->cislembaga->create($data);
        if ($result) {
            return redirect('cislembaga')->with('success', 'Data CIS PLUT-KUMKM Berhasil Disimpan');
        }
    }

    public function doEditData(Request $request, $id)
    {
        $data = $request->all();
        $cislembaga = $this->cislembaga->getById($id);
        $oldfile = $cislembaga->photo_gedung;

        if ($request->hasFile('photo_gedung')) {
            $file = Input::file('photo_gedung');
            $name = $this->upload_image($file, 'images', $oldfile);
            $data['photo_gedung'] = $name;
        }
        $result = $this->cislembaga->update($id, $data);
        if ($result) {
            return redirect('cislembaga')->with('info', 'Data CIS PLUT-KUMKM Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->cislembaga->delete($id);
        if ($result) {
            return redirect('cislembaga')->with('info', 'Data CIS PLUT-KUMKM Berhasil Diupdate');
        }
    }
}
