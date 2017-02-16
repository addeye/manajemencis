<?php

namespace App\Http\Controllers;

use App\Http\Traits\UploadTrait;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use UploadTrait;
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        $data=array(
            'data' => Auth::user()
        );
        return view('profile',$data);
    }

    public function doProfile(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'images' => 'image|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect('profile')
                ->withErrors($validator)
                ->withInput();
        }

        $user_data = $this->user->getById($id);
        $oldfile = $user_data->path;

        if($request->hasFile('images'))
        {
            $files = Input::file('images');
            //getting timestamp
            $name = $this->upload_image($files,'images',$oldfile);
            $data['path'] = $name;
        }

        $result = $this->user->update($id,$data);
        if($result)
        {
            return redirect('profile')->with('info','Data User Berhasil Dirubah');
        }

    }
}
