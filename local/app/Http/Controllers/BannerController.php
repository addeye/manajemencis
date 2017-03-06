<?php

namespace App\Http\Controllers;

use App\Http\Traits\UploadTrait;
use App\Repositories\BannerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    use UploadTrait;

    protected $banner;

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->banner = $bannerRepository;
    }

    public function index()
    {
        $data = array(
            'title' => 'Banner',
            'banner' => $this->banner->getAll()
        );
        return view('banner.list',$data);
    }

    public function add()
    {
        $data=array(
            'title' => 'Tambah Banner'
        );
        return view('banner.add',$data);
    }

    public function doAdd(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,[
            'image' => 'image|max:10000'
        ]);

        if ($validator->fails()) {
            return redirect('sbanner/add')
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('image'))
        {
            $file=Input::file('image');
            $name = $this->upload_image($file,'banner');
            $data['image'] = $name;
        }

        $result = $this->banner->create($data);
        if($result)
        {
            return redirect('sbanner')->with('success','Data Banner Berhasil Disimpan');
        }
    }

    public function edit($id)
    {
        $data=array(
            'title' => 'Edit Banner',
            'data' => $this->banner->getById($id)
        );
        return view('banner.edit',$data);
    }

    public function doEdit(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data,[
            'image' => 'image|max:10000'
        ]);

        if($validator->fails())
        {
            return redirect('sbanner/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $databanner = $this->banner->getById($id);
        $oldfile = $databanner->image;

        if($request->hasFile('image'))
        {
            $file=Input::file('image');
            $name = $this->upload_image($file,'banner',$oldfile);
            $data['image'] = $name;
        }

        $result = $this->banner->update($id,$data);
        if($result)
        {
            return redirect('sbanner')->with('info','Data Banner Berhasil Diupdate');
        }
    }

    public function destroy($id)
    {
        $data = $this->banner->getById($id);
        $oldfile = $data->image;

        $result = $this->banner->delete($id);
        if($result)
        {
            $this->delete_image('banner',$oldfile);
            return redirect('sbanner')->with('info','Data Banner Berhasil Dihapus');
        }

    }
}
