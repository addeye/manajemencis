<?php

namespace App\Http\Controllers;

use App\Cis_lembaga;
use Illuminate\Http\Request;
use App\Koperasi;
use App\Kumkm;
use App\SasaranProgram;
use App\ProgramKerja;
use App\Konsultan;
use App\PelaksanaanPendampingan;

class LapsevenController extends Controller
{
    private function helpTitle($data)
    {
        if ($data->type == 'Nasional') {
            return 'NASIONAL';
        } elseif ($data->type == 'Provinsi') {
            return 'DI PROVINSI ' . $data->provinces->name;
        } elseif ($data->type == 'Kab/Kota') {
            return 'DI ' . $data->regencies->name;
        } else {
            return '-';
        }
    }

    public function koperasi(Request $request)
    {
        $data = [
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get()
        ];

        if ($request->lembaga_id) {
            $lembaga = Cis_lembaga::find($request->lembaga_id);
            $data['lembaga_c'] = $lembaga;
            $data['title'] = $this->helpTitle($lembaga);
        }

        if ($request->tahun && $request->lembaga_id) {
            $tahun = $request->tahun - 1;
            $data['basekoperasi'] = Koperasi::with(['koperasi_detail' => function ($q) use ($tahun) {
                $q->whereYear('tanggal_keadaan', $tahun);
            }])->where('lembaga_id', $request->lembaga_id)->orderBy('regency_id', 'nama_koperasi')->get();
        }
        // return $data;
        return view('lapseven.koperasi', $data);
    }

    public function koperasiPrint(Request $request)
    {
        if ($request->lembaga_id) {
            $lembaga = Cis_lembaga::find($request->lembaga_id);
            $data['lembaga_c'] = $lembaga;
            $data['title'] = $this->helpTitle($lembaga);
        }

        if ($request->tahun && $request->lembaga_id) {
            $tahun = $request->tahun - 1;
            $data['basekoperasi'] = Koperasi::with(['koperasi_detail' => function ($q) use ($tahun) {
                $q->whereYear('tanggal_keadaan', $tahun);
            }])->where('lembaga_id', $request->lembaga_id)->orderBy('regency_id', 'nama_koperasi')->get();
        }
        return view('lapseven.koperasi_print', $data);
    }

    public function umkm(Request $request)
    {
        $data = [
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get()
        ];

        if ($request->lembaga_id) {
            $lembaga = Cis_lembaga::find($request->lembaga_id);
            $data['lembaga_c'] = $lembaga;
            $data['title'] = $this->helpTitle($lembaga);
        }

        if ($request->tahun && $request->lembaga_id) {
            $tahun = $request->tahun - 1;
            $data['baseumkm'] = Kumkm::whereHas('kumkm_detail', function ($q) use ($tahun) {$q->whereNotNull('id');})->with(['kumkm_detail' => function ($q) use ($tahun) {
                $q->whereYear('tanggal_keadaan', $tahun);
            }])->where('lembaga_id', $request->lembaga_id)->orderBy('regency_id', 'nama_usaha')->get();
        }

        return view('lapseven.umkm', $data);
    }

    public function umkmPrint(Request $request)
    {
        if ($request->lembaga_id) {
            $lembaga = Cis_lembaga::find($request->lembaga_id);
            $data['lembaga_c'] = $lembaga;
            $data['title'] = $this->helpTitle($lembaga);
        }

        if ($request->tahun && $request->lembaga_id) {
            $tahun = $request->tahun - 1;
            $data['baseumkm'] = Kumkm::whereHas('kumkm_detail', function ($q) use ($tahun) {$q->whereNotNull('id');})->with(['kumkm_detail' => function ($q) use ($tahun) {
                $q->whereYear('tanggal_keadaan', $tahun);
            }])->where('lembaga_id', $request->lembaga_id)->orderBy('regency_id', 'nama_usaha')->get();
        }

        return view('lapseven.umkm_print', $data);
    }

    public function sasaranKoperasi(Request $request)
    {
        $data = [
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get()
        ];

        if ($request->lembaga_id) {
            $lembaga = Cis_lembaga::find($request->lembaga_id);
            $data['lembaga_c'] = $lembaga;
            $data['title'] = $this->helpTitle($lembaga);
        }

        if ($request->tahun && $request->lembaga_id) {
            $tahun = $request->tahun;
            $data['basekoperasi'] = SasaranProgram::with('ukmtable')->where('ukmtable_type', 'koperasi')->where('lembaga_id', $request->lembaga_id)->where('tahun', $request->tahun)->get();
        }

        return view('lapseven.sasaran_koperasi', $data);
    }

    public function sasaranKoperasiPrint(Request $request)
    {
        if ($request->lembaga_id) {
            $lembaga = Cis_lembaga::find($request->lembaga_id);
            $data['lembaga_c'] = $lembaga;
            $data['title'] = $this->helpTitle($lembaga);
            $data['tanggal_print'] = $this->tanggal_indo(date('Y-m-d'));
        }

        if ($request->tahun && $request->lembaga_id) {
            $tahun = $request->tahun;
            $data['basekoperasi'] = SasaranProgram::with('ukmtable')->where('ukmtable_type', 'koperasi')->where('lembaga_id', $request->lembaga_id)->where('tahun', $request->tahun)->get();
        }
        // return $data;
        return view('lapseven.sasaran_koperasi_print', $data);
    }

    public function sasaranUmkm(Request $request)
    {
        $data = [
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get()
        ];

        if ($request->lembaga_id) {
            $lembaga = Cis_lembaga::find($request->lembaga_id);
            $data['lembaga_c'] = $lembaga;
            $data['title'] = $this->helpTitle($lembaga);
        }

        if ($request->tahun && $request->lembaga_id) {
            $tahun = $request->tahun;
            $data['baseumkm'] = SasaranProgram::with('ukmtable')->where('ukmtable_type', 'kumkm')->where('lembaga_id', $request->lembaga_id)->where('tahun', $request->tahun)->get();
        }

        return view('lapseven.sasaran_umkm', $data);
    }

    public function sasaranUmkmPrint(Request $request)
    {
        if ($request->lembaga_id) {
            $lembaga = Cis_lembaga::find($request->lembaga_id);
            $data['lembaga_c'] = $lembaga;
            $data['title'] = $this->helpTitle($lembaga);
            $data['tanggal_print'] = $this->tanggal_indo(date('Y-m-d'));
        }

        if ($request->tahun && $request->lembaga_id) {
            $tahun = $request->tahun;
            $data['baseumkm'] = SasaranProgram::with('ukmtable')->where('ukmtable_type', 'kumkm')->where('lembaga_id', $request->lembaga_id)->where('tahun', $request->tahun)->get();
        }

        return view('lapseven.sasaran_umkm_print', $data);
    }

    public function programKerja(Request $request)
    {
        $data = [
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get(),
        ];

        if ($request->lembaga_id) {
            $lembaga = Cis_lembaga::find($request->lembaga_id);
            $data['lembaga_c'] = $lembaga;
            $data['title'] = $this->helpTitle($lembaga);
            $data['sasaran_program'] = SasaranProgram::with('ukmtable')->where('lembaga_id', $request->lembaga_id)->get();
        }

        if ($request->tahun && $request->lembaga_id && $request->sasaran_program_id) {
            $data['kumkm'] = SasaranProgram::find($request->sasaran_program_id);
            $data['data'] = ProgramKerja::with('sasaran_program')->where('tahun', $request->tahun)->where('sasaran_program_id', $request->sasaran_program_id)->where('lembaga_id', $request->lembaga_id)->get();
        }
        // return $data;
        return view('lapseven.program_pendampingan', $data);
    }

    public function programKerjaPrint(Request $request)
    {
        $data = [
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get(),
        ];

        if ($request->lembaga_id) {
            $lembaga = Cis_lembaga::find($request->lembaga_id);
            $data['lembaga_c'] = $lembaga;
            $data['title'] = $this->helpTitle($lembaga);
            $data['sasaran_program'] = SasaranProgram::with('ukmtable')->where('lembaga_id', $request->lembaga_id)->get();
            $data['tanggal_print'] = $this->tanggal_indo(date('Y-m-d'));
        }

        if ($request->tahun && $request->lembaga_id) {
            $data['kumkm'] = SasaranProgram::find($request->sasaran_program_id);
            $data['data'] = ProgramKerja::with('sasaran_program')->where('tahun', $request->tahun)->where('sasaran_program_id', $request->sasaran_program_id)->where('lembaga_id', $request->lembaga_id)->get();
        }
        // return $data;
        return view('lapseven.program_pendampingan_print', $data);
    }

    public function pelaksanaan(Request $request)
    {
        $data = [
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get(),
        ];

        if ($request->lembaga_id) {
            $lembaga = Cis_lembaga::find($request->lembaga_id);
            $data['lembaga_c'] = $lembaga;
            $data['title'] = $this->helpTitle($lembaga);
            $data['sasaran_program'] = SasaranProgram::with('ukmtable')->where('lembaga_id', $request->lembaga_id)->get();
            $data['konsultan'] = Konsultan::where('lembagaid', $request->lembaga_id)->get();
            $data['tanggal_print'] = $this->tanggal_indo(date('Y-m-d'));
        }

        if ($request->tahun && $request->lembaga_id) {
            $data['kumkm'] = SasaranProgram::find($request->sasaran_program_id);
            $data['data'] = ProgramKerja::with('sasaran_program')->where('tahun', $request->tahun)->where('sasaran_program_id', $request->sasaran_program_id)->where('lembaga_id', $request->lembaga_id)->get();
        }
        // return $data;
        return view('lapseven.pelaksanaan_pendampingan', $data);
    }

    public function getContentPelaksanaan(Request $request)
    {
        // return $request->all();
        $pp = PelaksanaanPendampingan::where('konsultan_id', $request->konsultan_id)->whereYear('tanggal', $request->tahun)->get();
        $ss = SasaranProgram::find($request->kumkm_sasaran_id);
        $l = Cis_lembaga::find($request->lembaga_id);
        $k = Konsultan::find($request->konsultan_id);
        $data = [
            'data' => $pp->where('kumkm_id', $ss->ukmtable_id),
            'lembaga' => $l,
            'sasaran' => $ss,
            'title' => $this->helpTitle($l),
            'tahun' => $request->tahun,
            'konsultan' => $k
        ];

        return view('lapseven.components.conten_pelaksanaan', $data);
    }

    public function pelaksanaanPrint(Request $request)
    {
        $pp = PelaksanaanPendampingan::where('konsultan_id', $request->konsultan_id)->whereYear('tanggal', $request->tahun)->get();
        $ss = SasaranProgram::find($request->kumkm_sasaran_id);
        $l = Cis_lembaga::find($request->lembaga_id);
        $k = Konsultan::find($request->konsultan_id);
        $data = [
            'data' => $pp->where('kumkm_id', $ss->ukmtable_id),
            'lembaga' => $l,
            'sasaran' => $ss,
            'title' => $this->helpTitle($l),
            'tahun' => $request->tahun,
            'konsultan' => $k
        ];

        $data['tanggal_print'] = $this->tanggal_indo(date('Y-m-d'));

        return view('lapseven.pelaksanaan_pendampingan_print', $data);
    }

    public function pelaksanaanFinal()
    {
        return view('lapseven.pelaksanaan.index');
    }

    public function pelaksanaanBulanan()
    {
        $data = [
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get()
        ];

        return view('lapseven.pelaksanaan.bulanan', $data);
    }

    public function pelaksanaanBulananShow(Request $request)
    {
        // return $request->all();
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $lembaga_id = $request->lembaga_id;
        $konsultan_id = $request->konsultan_id;

        $l = Cis_lembaga::find($lembaga_id);
        $k = Konsultan::find($konsultan_id);

        $plp = PelaksanaanPendampingan::whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->where('konsultan_id', $konsultan_id)->where('lembaga_id', $lembaga_id)->get();
        $data = [
            'data' => $plp,
            'title' => $this->helpTitle($l),
            'tahun' => $tahun,
            'konsultan' => $k
        ];
        return view('lapseven.pelaksanaan.bulanan_show', $data);
    }

    public function pelaksanaanBulananPrint(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $lembaga_id = $request->lembaga_id;
        $konsultan_id = $request->konsultan_id;

        $l = Cis_lembaga::find($lembaga_id);
        $k = Konsultan::find($konsultan_id);

        $plp = PelaksanaanPendampingan::whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->where('konsultan_id', $konsultan_id)->where('lembaga_id', $lembaga_id)->get();
        $data = [
            'data' => $plp,
            'title' => $this->helpTitle($l),
            'tahun' => $tahun,
            'konsultan' => $k,
            'lembaga' => $l
        ];
        $data['tanggal_print'] = $this->tanggal_indo(date('Y-m-d'));
        return view('lapseven.pelaksanaan.bulanan_print', $data);
    }

    public function pelaksanaanTriwulan()
    {
        $data = [
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get()
        ];

        return view('lapseven.pelaksanaan.triwulan', $data);
    }

    private function generateDateTriwulan($tw, $thn)
    {
        if ($tw == 'tw1') {
            return [
                'start' => $thn . '-01-01',
                'end' => $thn . '-03-31'
            ];
        } elseif ($tw == 'tw2') {
            return [
                'start' => $thn . '-04-01',
                'end' => $thn . '-06-30'
            ];
        } elseif ($tw == 'tw3') {
            return [
                'start' => $thn . '-07-01',
                'end' => $thn . '-09-30'
            ];
        } elseif ($tw == 'tw4') {
            return [
                'start' => $thn . '-10-01',
                'end' => $thn . '-12-31'
            ];
        }
    }

    public function pelaksanaanTriwulanShow(Request $request)
    {
        // return $request->all();
        $tahun = $request->tahun;
        $triwulan = $request->triwulan;
        $lembaga_id = $request->lembaga_id;
        $konsultan_id = $request->konsultan_id;

        $l = Cis_lembaga::find($lembaga_id);
        $k = Konsultan::find($konsultan_id);

        $op = $this->generateDateTriwulan($triwulan, $tahun);

        $plp = PelaksanaanPendampingan::whereBetween('tanggal', [$op['start'], $op['end']])->where('konsultan_id', $konsultan_id)->where('lembaga_id', $lembaga_id)->orderBy('tanggal')->get();
        $data = [
            'data' => $plp,
            'title' => $this->helpTitle($l),
            'tahun' => $tahun,
            'konsultan' => $k
        ];
        return view('lapseven.pelaksanaan.triwulan_show', $data);
    }

    public function pelaksanaanTriwulanPrint(Request $request)
    {
        // return $request->all();
        $tahun = $request->tahun;
        $triwulan = $request->triwulan;
        $lembaga_id = $request->lembaga_id;
        $konsultan_id = $request->konsultan_id;

        $l = Cis_lembaga::find($lembaga_id);
        $k = Konsultan::find($konsultan_id);

        $op = $this->generateDateTriwulan($triwulan, $tahun);

        $plp = PelaksanaanPendampingan::whereBetween('tanggal', [$op['start'], $op['end']])->where('konsultan_id', $konsultan_id)->where('lembaga_id', $lembaga_id)->orderBy('tanggal')->get();
        $data = [
            'data' => $plp,
            'title' => $this->helpTitle($l),
            'tahun' => $tahun,
            'konsultan' => $k,
            'lembaga' => $l
        ];
        $data['tanggal_print'] = $this->tanggal_indo(date('Y-m-d'));
        return view('lapseven.pelaksanaan.triwulan_print', $data);
    }

    public function pelaksanaanTahunan()
    {
        $data = [
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get()
        ];

        return view('lapseven.pelaksanaan.tahunan', $data);
    }

    public function pelaksanaanTahunanShow(Request $request)
    {
        // return $request->all();
        $tahun = $request->tahun;
        $lembaga_id = $request->lembaga_id;
        $konsultan_id = $request->konsultan_id;

        $l = Cis_lembaga::find($lembaga_id);
        $k = Konsultan::find($konsultan_id);

        $plp = PelaksanaanPendampingan::whereYear('tanggal', $tahun)->where('konsultan_id', $konsultan_id)->where('lembaga_id', $lembaga_id)->orderBy('tanggal')->get();
        $data = [
            'data' => $plp,
            'title' => $this->helpTitle($l),
            'tahun' => $tahun,
            'konsultan' => $k
        ];
        return view('lapseven.pelaksanaan.tahunan_show', $data);
    }

    public function pelaksanaanTahunanPrint(Request $request)
    {
        // return $request->all();
        $tahun = $request->tahun;
        $lembaga_id = $request->lembaga_id;
        $konsultan_id = $request->konsultan_id;

        $l = Cis_lembaga::find($lembaga_id);
        $k = Konsultan::find($konsultan_id);

        $plp = PelaksanaanPendampingan::whereYear('tanggal', $tahun)->where('konsultan_id', $konsultan_id)->where('lembaga_id', $lembaga_id)->orderBy('tanggal')->get();
        $data = [
            'data' => $plp,
            'title' => $this->helpTitle($l),
            'tahun' => $tahun,
            'konsultan' => $k,
            'lembaga' => $l
        ];
        $data['tanggal_print'] = $this->tanggal_indo(date('Y-m-d'));
        return view('lapseven.pelaksanaan.tahunan_print', $data);
    }

    public function kumkmPerBidang(Request $request)
    {
        $start = $request->has('start') ? date('Y-m-d', strtotime($request->start)) : '';
        $end = $request->has('end') ? date('Y-m-d', strtotime($request->end)) : '';

        if ($start && $end) {
            if (strtotime($start) > strtotime($end)) {
                return redirect('laporan-kumkm-perbidang')->with('error', 'Tanggal Dari tidak boleh lebih besar dari Tanggal Sampai')->withInput();
            }
        }

        $lembaga = Cis_lembaga::orderBy('id_lembaga', 'ASC')->get();
        $pelaksanaan = [];

        if ($request->has('lembaga_id')) {
            $pelaksanaan = SasaranProgram::where('lembaga_id', $request->lembaga_id)->whereBetween('created_at', [$start, $end])->get();
        }

        $data = [
            'lembaga' => $lembaga,
            'data' => $pelaksanaan
        ];
        return view('lapseven.kumkmperbidang', $data);
    }
}
