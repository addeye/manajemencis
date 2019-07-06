<?php

namespace App\Http\Controllers\Monev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cis_lembaga;
use App\Koperasi;

class KoperasiController extends Controller
{
    public function all(Request $request)
    {
        $tahun = $request->tahun;
        $lembaga_id = $request->lembaga_id;

        $content = Koperasi::query();

        $content->with('koperasi_detail');

        if ($tahun == '') {
            $tahun = date('Y');
        }

        if ($request->tahun) {
            // $content->whereHas('koperasi_detail', function ($q) use ($tahun) {
            // 	$q->whereYear('tanggal_keadaan', $tahun);
            // });

            $content->with(['koperasi_detail' => function ($q) use ($tahun) {
                $q->whereYear('tanggal_keadaan', $tahun);
            }]);
        }

        if ($lembaga_id != '') {
            $content->where('lembaga_id', $lembaga_id);
        }

        $content = $content->paginate();

        $data = [
            'data' => $content,
            'tahun' => $tahun,
            'lembaga' => Cis_lembaga::all(),
            'lembaga_id' => $lembaga_id,
        ];
        // return $data;
        return view('dashboard.monev.koperasi.list', $data);
    }

    public function detail($id)
    {
        $data = [
            'data' => Koperasi::find($id),
        ];
        return view('dashboard.monev.koperasi.show', $data);
    }
}
