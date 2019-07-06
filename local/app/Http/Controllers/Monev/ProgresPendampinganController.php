<?php

namespace App\Http\Controllers\Monev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cis_lembaga;
use Maatwebsite\Excel\Facades\Excel;

class ProgresPendampinganController extends Controller
{
    public function all(Request $request)
    {
        $start = $request->start ? date('Y-m-d', strtotime($request->start)) : '';
        $end = $request->end ? date('Y-m-d', strtotime($request->end)) : '';

        if ($start && $end) {
            if (strtotime($start) > strtotime($end)) {
                return redirect('progres-pendampingan')->with('error', 'Tanggal Dari tidak boleh lebih besar dari Tanggal Sampai')->withInput();
            }
        }

        $content = Cis_lembaga::query();

        $content->where('id_lembaga', '!=', '999900');

        if ($start && $end) {
            $content->withCount([
                'kumkm' => function ($q) use ($end) {$q->whereDate('created_at', '<=', $end);},

                'koperasi' => function ($q) use ($end) {$q->whereDate('created_at', '<=', $end);},

                'sasaran_program AS sasaran_program_koperasi' => function ($q) use ($start, $end) {$q->where('ukmtable_type', 'koperasi')->whereBetween('created_at', [$start, $end]);},

                'sasaran_program AS sasaran_program_umkm' => function ($q) use ($start, $end) {$q->where('ukmtable_type', 'kumkm')->whereBetween('created_at', [$start, $end]);},

                'program_kerja' => function ($q) use ($start, $end) {
                    $q->whereBetween('created_at', [$start, $end]);
                },
                'pelaksanaan_pendampingan' => function ($q) use ($start, $end) {$q->whereBetween('created_at', [$start, $end]);},
            ]);
        } else {
            $content->withCount([
                'kumkm',
                'koperasi',
                'sasaran_program AS sasaran_program_koperasi' => function ($q) {$q->where('ukmtable_type', 'koperasi');},
                'sasaran_program AS sasaran_program_umkm' => function ($q) {$q->where('ukmtable_type', 'kumkm');},
                'program_kerja', 'pelaksanaan_pendampingan',
            ]);
        }

        $content->orderBy('id_lembaga');

        $content = $content->get();

        $koperasi = [];
        $umkm = [];
        $sasaran_program_koperasi = [];
        $sasaran_program_umkm = [];
        $program_kerja = [];
        $pelaksanaan = [];

        foreach ($content as $key => $value) {
            $koperasi[] = $value->koperasi_count;
            $umkm[] = $value->kumkm_count;
            $sasaran_program_koperasi[] = $value->sasaran_program_koperasi_count;
            $sasaran_program_umkm[] = $value->sasaran_program_umkm_count;
            $program_kerja[] = $value->program_kerja_count;
            $pelaksanaan[] = $value->pelaksanaan_pendampingan_count;
        }

        $data = [
            'data' => $content,
            'start' => $start ? date('d-m-Y', strtotime($start)) : '',
            'end' => $end ? date('d-m-Y', strtotime($end)) : '',
            'koperasi_count' => array_sum($koperasi),
            'umkm_count' => array_sum($umkm),
            'sasaran_koperasi_count' => array_sum($sasaran_program_koperasi),
            'sasaran_umkm_count' => array_sum($sasaran_program_umkm),
            'program_kerja_count' => array_sum($program_kerja),
            'pelaksanaan_count' => array_sum($pelaksanaan),
        ];
        return view('dashboard.monev.progress.list', $data);
    }

    public function export(Request $request)
    {
        $start = $request->start ? date('Y-m-d', strtotime($request->start)) : '';
        $end = $request->end ? date('Y-m-d', strtotime($request->end)) : '';

        if ($start && $end) {
            if (strtotime($start) > strtotime($end)) {
                return redirect('progres-pendampingan')->with('error', 'Tanggal Dari tidak boleh lebih besar dari Tanggal Sampai')->withInput();
            }
        }

        $content = Cis_lembaga::query();
        $content->where('id_lembaga', '!=', '999900');

        if ($start && $end) {
            $content->withCount([
                'kumkm' => function ($q) use ($start, $end) {$q->where('created_at', '>=', $start)->where('created_at', '<=', $end);},

                'koperasi' => function ($q) use ($start, $end) {$q->where('created_at', '>=', $start)->where('created_at', '<=', $end);},

                'sasaran_program AS sasaran_program_koperasi' => function ($q) use ($start, $end) {$q->where('ukmtable_type', 'koperasi')->where('created_at', '>=', $start)->where('created_at', '<=', $end);},

                'sasaran_program AS sasaran_program_umkm' => function ($q) use ($start, $end) {$q->where('ukmtable_type', 'kumkm')->where('created_at', '>=', $start)->where('created_at', '<=', $end);},

                'program_kerja' => function ($q) use ($start, $end) {
                    $q->where('created_at', '>=', $start)->where('created_at', '<=', $end);
                },
                'pelaksanaan_pendampingan' => function ($q) use ($start, $end) {$q->where('created_at', '>=', $start)->where('created_at', '<=', $end);},
            ]);
        } else {
            $content->withCount([
                'kumkm',
                'koperasi',
                'sasaran_program AS sasaran_program_koperasi' => function ($q) {$q->where('ukmtable_type', 'koperasi');},
                'sasaran_program AS sasaran_program_umkm' => function ($q) {$q->where('ukmtable_type', 'kumkm');},
                'program_kerja', 'pelaksanaan_pendampingan',
            ]);
        }
        $content->orderBy('id_lembaga');

        $data = $content->get();

        if ($data->count() == 0) {
            return redirect('progres-pendampingan')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
        }

        return Excel::create('Progres Pendampingan ' . $start . '-' . $end . '(' . date('d-m-Y') . ')', function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->cell('A1', function ($cell) {$cell->setValue('ID Lembaga');});
                $sheet->cell('B1', function ($cell) {$cell->setValue('Lembaga');});
                $sheet->cell('C1', function ($cell) {$cell->setValue('Form 7A');});
                $sheet->cell('D1', function ($cell) {$cell->setValue('Form 7B');});
                $sheet->cell('E1', function ($cell) {$cell->setValue('Form 7C');});
                $sheet->cell('F1', function ($cell) {$cell->setValue('Form 7D');});
                $sheet->cell('G1', function ($cell) {$cell->setValue('Form 7E');});
                $sheet->cell('H1', function ($cell) {$cell->setValue('Form 7F');});
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $i = $key + 2;
                        $sheet->cell('A' . $i, $value->id_lembaga);
                        $sheet->cell('B' . $i, $value->plut_name);
                        $sheet->cell('C' . $i, $value->koperasi_count);
                        $sheet->cell('D' . $i, $value->kumkm_count);
                        $sheet->cell('E' . $i, $value->sasaran_program_koperasi_count);
                        $sheet->cell('F' . $i, $value->sasaran_program_umkm_count);
                        $sheet->cell('G' . $i, $value->program_kerja_count);
                        $sheet->cell('H' . $i, $value->pelaksanaan_pendampingan_count);
                    }
                }
            });
        })->download('xlsx');
    }
}
