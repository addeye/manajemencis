<?php

namespace App\Http\Controllers\Monev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kumkm;
use App\Cis_lembaga;

class UmkmController extends Controller
{
    public function all(Request $request)
    {
        $tahun = $request->tahun;
        $lembaga_id = $request->lembaga_id;

        $content = Kumkm::query();

        if ($tahun == '') {
            $tahun = date('Y');
        }

        if ($request->tahun) {
            // $content->whereHas('kumkm_detail', function ($q) use ($tahun) {
            //  $q->whereYear('tanggal_keadaan', $tahun);
            // });

            $content->with(['kumkm_detail' => function ($q) use ($tahun) {
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
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get(),
            'lembaga_id' => $lembaga_id,
        ];

        return view('dashboard.monev.umkm.list', $data);
    }

    public function detail($id)
    {
        $data = [
            'data' => Kumkm::find($id),
        ];
        return view('dashboard.monev.umkm.show', $data);
    }
}
