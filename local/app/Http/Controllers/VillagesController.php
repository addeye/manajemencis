<?php

namespace App\Http\Controllers;

use App\Repositories\DistrictsRepository;
use App\Repositories\VillagesRepository;
use Illuminate\Http\Request;

class VillagesController extends Controller
{
    protected $villages;
    protected $districts;

    public function __construct(VillagesRepository $villages, DistrictsRepository $districts)
    {
        $this->villages = $villages;
        $this->districts = $districts;
    }

    public function addData($district_id)
    {
        $data = Array
        (
            'title' => 'Tambah Data Kelurahan',
            'district' => $this->districts->getById($district_id)

        );
        return view('districts.add_villages',$data);
    }

    public function doAddData(Request $request)
    {
//        return $request->all();
        $data = array(
            'id' => $request->id,
            'district_id' => $request->district_id,
            'name' => $request->name
        );
        $result = $this->villages->create($data);
        if($result)
        {
            return redirect('districts/'.$request->district_id.'/villages')->with('success','Data Bidang Layanan Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $data = array(
            'title' => 'Edit Kelurahan',
            'data' => $this->villages->getById($id)
        );
        return view('districts.edit_villages',$data);
    }

    public function doEditData(Request $request,$id)
    {
        $data = array(
            'id'=>$request->id,
            'name'=>$request->name,
        );
        $result = $this->provinces->update($id,$data);
        if($result)
        {
            return redirect('provinces')->with('info','Data Bidang Layanan Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->provinces->delete($id);
        if($result)
        {
            return redirect('provinces')->with('info','Data Bidang Layanan Berhasil Dihapus');
        }
    }
}
