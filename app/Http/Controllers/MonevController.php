<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monev;
use App\User;
use Validator;

class MonevController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'data' => Monev::orderBy('created_at', 'DESC')->get()
        ];
        return view('monev.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('monev.add');
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
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'telp' => 'numeric|unique:pengelolah,telp'
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
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
        $user->name = $request->name;
        $user->role_id = 6;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($user) {
            $monev = new Monev();
            $monev->user_id = $user->id;
            $monev->name = $request->name;
            $monev->email = $request->email;
            $monev->telp = $request->telp;
            $monev->save();

            if ($monev) {
                return redirect('monev')->with('success', 'Berhasil membuat akun monev');
            }
        }

        if ($user) {
            $u = $user;
            $u->delete();
            return redirect()->back()->with('error', 'Tidak Berhasil membuat akun monev');
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
            'data' => Monev::findOrFail($id),
        ];
        return view('monev.edit', $data);
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
        $monev = Monev::findOrFail($id);
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $monev->user_id,
            'telp' => 'numeric|unique:monev,telp,' . $monev->id
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
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
        $user->name = $request->name;
        $user->role_id = 6;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        if ($user) {
            $monev->user_id = $user->id;
            $monev->name = $request->name;
            $monev->email = $request->email;
            $monev->telp = $request->telp;
            $monev->save();

            if ($monev) {
                return redirect('monev')->with('success', 'Berhasil perbaruhi akun monev');
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
        $p = Monev::findOrFail($id);
        $u = $p->users;
        $p->delete();
        $u->status = 'nonaktif';
        $u->save();
        return redirect('monev')->with('success', 'Berhasil hapus data');
    }
}
