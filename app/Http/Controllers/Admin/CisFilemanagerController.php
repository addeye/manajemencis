<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadTrait;
use App\Repositories\CisFilemanagerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CisFilemanagerController extends Controller
{
    use UploadTrait;
    protected $cisfilemanager;

    public function __construct(CisFilemanagerRepository $cisFilemanagerRepository)
    {
        $this->cisfilemanager = $cisFilemanagerRepository;
    }

    public function doAddData(Request $request)
    {
        $result = array();
        if($request->hasFile('photo'))
        {
            $files = Input::file('photo');

            foreach($files as $file)
            {
                $name = $this->upload_image($file,'image');
                $data=array(
                    'cis_lembaga_id' => $request->cis_lembaga_id,
                    'tipe' => $request->tipe,
                    'photo' => $name
                );
                $result[] = $this->cisfilemanager->create($data);
            }
            if(count($result))
            {
                return redirect()->back()->with('info','Data photo Berhasil Disimpan');
            }
        }

    }

    public function deleteData($id)
    {
        $data = $this->cisfilemanager->getById($id);
        $old = $data->photo;
        $result = $this->delete_image('image',$old);
        if($result)
        {
            $this->cisfilemanager->delete($id);
            return redirect()->back()->with('info','Data photo Berhasil Dihapus');
        }
    }
}
