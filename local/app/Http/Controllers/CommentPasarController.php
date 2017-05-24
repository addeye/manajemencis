<?php

namespace App\Http\Controllers;

use App\Repositories\CommentPasarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentPasarController extends Controller
{
    protected $comment;

    public function __construct(CommentPasarRepository $commentPasarRepository)
    {
        $this->comment = $commentPasarRepository;
    }

    public function doAdd(Request $request)
    {
        $data = $request->all();
        $rules=[
            'komentar' => 'required'
        ];

        $messages =[
            'komentar.required' => 'Komentar tidak boleh kosong'
        ];

        $validator = Validator::make($data,$rules,$messages);
        if($validator->fails())
        {
            return redirect('informasi/'.$request->informasi_pasar_id.'/detail')
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'informasi_pasar_id' => $request->informasi_pasar_id,
            'komentar' => $request->komentar
        ];

        if(Auth::user())
        {
            $data['nama'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
        }
        else
        {
            $data['nama'] = str_random(6);
            $data['email'] = 'pengunjung@gmail.com';
        }

        $result = $this->comment->create($data);
        if($result)
        {
            return redirect('informasi/'.$request->informasi_pasar_id.'/detail')->with('success','Berhasil menambahkan komentar');
        }
        else
        {
            return redirect('informasi/'.$request->informasi_pasar_id.'/detail')->with('error','Maaf gagal menambahkan komentar silahkan hubungi Administrator');
        }
    }
}
