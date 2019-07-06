<?php

namespace App\Http\Controllers\Monev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PelaksanaanPendampingan;
use App\Cis_lembaga;
use App\Bidang_layanan;

class PelaksanaanController extends Controller
{
    public function all(Request $request)
    {
        $nama_kumkm = $request->nama_kumkm;
        $tahun = $request->tahun;
        $lembaga_id = $request->lembaga_id;

        $content = PelaksanaanPendampingan::query();

        $content->with('program_kerja');

        if ($request->nama_kumkm) {
            $content->where('nama_kumkm', 'like', '%' . $nama_kumkm . '%');
        }

        if ($request->lembaga_id) {
            $content->where('lembaga_id', $lembaga_id);
        }

        if ($tahun == '') {
            $tahun = date('Y');
        }

        $content->whereYear('tanggal', $tahun);

        $content = $content->paginate();

        $data = [
            'data' => $content,
            'nama_kumkm' => $nama_kumkm,
            'tahun' => $tahun,
            'lembaga_id' => $lembaga_id,
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get(),
        ];
        // return $data;
        return view('dashboard.monev.pelaksanaan.list', $data);
    }

    public function rekapPelaksanaanPerBidang()
    {
        $data = Cis_lembaga::with('pelaksanaan_pendampingan.konsultans')->orderBy('id_lembaga', 'ASC')->get();
        // $data = $data->pelaksanaan_pendampingan->filter(function ($item) {
        //     return $item->konsultans->bidang_layanan_id == 4;
        // });
        // return $data;
        $bdl = Bidang_layanan::all();

        $data = [
            'data' => $data,
            'bidang_layanan' => $bdl
        ];
        return view('dashboard.monev.pelaksanaan.rekap_perbidang', $data);
    }
}
