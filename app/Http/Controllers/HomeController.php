<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
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

        if($request->hasFile('images'))
        {
            $files = Input::file('images');
            //getting timestamp
            $timestamp = str_replace(['',':'],' pp -',Carbon::now()->toDateTimeString());
            $name = $timestamp.'-'.$files->getClientOriginalName();
            $data['path'] = $name;
            $files->move(public_path().'/images/',$name);
        }

        $result = $this->user->update($id,$data);
        if($result)
        {
            return redirect('profile')->with('info','Data User Berhasil Dirubah');
        }

    }
}
