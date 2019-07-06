<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengelolah;
use App\Cis_lembaga;
use App\User;
use Validator;

class PengelolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'data' => Pengelolah::all()
        ];
        return view('pengelolah.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'lembaga' => Cis_lembaga::orderBy('id_lembaga')->get()
        ];
        return view('pengelolah.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $rules = [
            'nama_lengkap' => 'required',
            'email' => 'required|unique:users,email',
            'telp' => 'numeric|unique:pengelolah,telp'
        ];

        $messages = [
            'nama_lengkap.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email ada yang sama dengan pengguna lain',
            'telp.unique' => 'Telp ada yang sama dengan pengguna lain',
            'telp.numeric' => 'Telp harus berupa angka'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->nama_lengkap;
        $user->role_id = 5;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($user) {
            $pengelolah = new Pengelolah();
            $pengelolah->user_id = $user->id;
            $pengelolah->lembaga_id = $request->lembaga_id;
            $pengelolah->name = $request->nama_lengkap;
            $pengelolah->email = $request->email;
            $pengelolah->telp = $request->telp;
            $pengelolah->save();

            if ($pengelolah) {
                return redirect('pengelolah')->with('success', 'Berhasil membuat akun pengelolah');
            }
        }

        if ($user) {
            $u = $user;
            $u->delete();
            return redirect()->back()->with('error', 'Tidak Berhasil membuat akun pengelolah');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'data' => Pengelolah::findOrFail($id),
            'lembaga' => Cis_lembaga::orderBy('id_lembaga')->get()
        ];
        return view('pengelolah.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pengelolah = Pengelolah::find($id);
        $rules = [
            'nama_lengkap' => 'required',
            'email' => 'required|unique:users,email,' . $pengelolah->user_id,
            'telp' => 'numeric|unique:pengelolah,telp,' . $pengelolah->id
        ];

        $messages = [
            'nama_lengkap.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email ada yang sama dengan pengguna lain',
            'telp.unique' => 'Telp ada yang sama dengan pengguna lain',
            'telp.numeric' => 'Telp harus berupa angka'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();
        $user->name = $request->nama_lengkap;
        $user->role_id = 5;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        if ($user) {
            $pengelolah->user_id = $user->id;
            $pengelolah->lembaga_id = $request->lembaga_id;
            $pengelolah->name = $request->nama_lengkap;
            $pengelolah->email = $request->email;
            $pengelolah->telp = $request->telp;
            $pengelolah->save();

            if ($pengelolah) {
                return redirect('pengelolah')->with('success', 'Berhasil perbaruhi akun pengelolah');
            }
        }

        if ($user) {
            return redirect()->back()->with('error', 'Tidak Berhasil perbaruhi akun pengelolah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Pengelolah::findOrFail($id);
        $u = $p->users;
        $p->delete();
        $u->status = 'nonaktif';
        $u->save();
        return redirect()->back()->with('success', 'Berhasil hapus data');
    }
}
