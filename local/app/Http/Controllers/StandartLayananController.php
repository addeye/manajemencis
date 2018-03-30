<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StandartLayanan;
use App\Bidang_layanan;

class StandartLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
                'data' => StandartLayanan::all(),
                'title' => 'Standart Layanan'
            );
        return view('standart_layanan.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
                'title' => 'Tambah Standart Layanan',
                'bidanglayanan' => Bidang_layanan::all()
            );
        return view('standart_layanan.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stlayanan = new StandartLayanan();
        $stlayanan->bidang_layanan_id = $request->bidang_layanan_id;
        $stlayanan->nama = $request->nama;
        $stlayanan->save();

        if($stlayanan)
        {
            return redirect('standart-layanan')->with('success','Data Standart Layanan Berhasil Disimpan');
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
        $data = array(
                'title' => 'Edit Standart Layanan',
                'data' => StandartLayanan::find($id),
                'bidanglayanan' => Bidang_layanan::all()
            );
        return view('standart_layanan.edit',$data); 
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
        $stlayanan = StandartLayanan::find($id);
        $stlayanan->bidang_layanan_id = $request->bidang_layanan_id;
        $stlayanan->nama = $request->nama;
        $stlayanan->save();

        if($stlayanan)
        {
            return redirect('standart-layanan')->with('success','Data Standart Layanan Berhasil Diupdate');
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
        $result = StandartLayanan::find($id);
        $result->delete();
    }
}
