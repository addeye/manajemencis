<?php

namespace App\Http\Controllers\Monev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SasaranProgram;
use App\Cis_lembaga;

class SasaranUmkmController extends Controller
{
    public function all(Request $request)
    {
        $tahun = $request->tahun;
        $lembaga_id = $request->lembaga_id;

        $content = SasaranProgram::query();

        $content->with('ukmtable')->where('ukmtable_type', 'kumkm');

        if ($lembaga_id) {
            $content->where('lembaga_id', $lembaga_id);
        }

        if ($tahun == '') {
            $tahun = date('Y');
        }

        $content->where('tahun', $tahun);

        $content = $content->paginate();

        $data = [
            'data' => $content,
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get(),
        ];

        // return $data;

        return view('dashboard.monev.sasaran.umkm.list', $data);
    }
}
