<?php

namespace App\Http\Controllers;

use App\Cis_lembaga;
use App\SasaranProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class SasaranProgramUmkmController extends Controller
{
    public function getList()
    {
        $tahun = Input::get('tahun');
        $lembaga_id = Input::get('lembaga_id');

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
            'lembaga' => Cis_lembaga::all(),
            'tahun' => $tahun,
            'lembaga_id' => $lembaga_id,
        ];

        // return $data;

        return view('sasaran_kumkm.list', $data);
    }

    public function lock(Request $request, $id)
    {
        $statuslock = $request->lock;
        if ($statuslock == 'Yes') {
            $lock = 'No';
        } elseif ($statuslock == 'No') {
            $lock = 'Yes';
        }
        $data = SasaranProgram::find($id);
        $data->lock = $lock;
        $data->save();

        if ($data) {
            return redirect('sasaran-program-umkm')->with('success', 'Status LOCK menjadi ' . $lock);
        }
    }

    public function export()
    {
        $tahun = Input::get('tahun');
        $lembaga_id = Input::get('lembaga_id');

        $nama_lembaga = '';

        $content = SasaranProgram::query();

        $content->with('ukmtable')->where('ukmtable_type', 'kumkm');

        if ($lembaga_id) {
            $content->where('lembaga_id', $lembaga_id);
            $lembagarow = Cis_lembaga::find($lembaga_id);

            $nama_lembaga = $lembagarow->plut_name;
        }

        if ($tahun == '') {
            $tahun = date('Y');
        }

        $content->where('tahun', $tahun);

        $data = $content->get();

        if ($data->count() == 0) {
            return redirect('sasaran-program-umkm')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
        }

        return Excel::create('Sasaran Program UMKM ' . $nama_lembaga . ' ' . $tahun, function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->cell('A1', function ($cell) {$cell->setValue('Lembaga');});
                $sheet->cell('B1', function ($cell) {$cell->setValue('ID UMKM');});
                $sheet->cell('C1', function ($cell) {$cell->setValue('Nama UMKM');});
                $sheet->cell('D1', function ($cell) {$cell->setValue('Alamat');});
                $sheet->cell('E1', function ($cell) {$cell->setValue('Tahun Mulai Usaha');});
                $sheet->cell('F1', function ($cell) {$cell->setValue('Jenis Usaha');});
                $sheet->cell('G1', function ($cell) {$cell->setValue('Legalitas');});
                $sheet->cell('H1', function ($cell) {$cell->setValue('Tenaga Kerja (Orang)');});
                $sheet->cell('I1', function ($cell) {$cell->setValue('Modal Sendiri');});
                $sheet->cell('J1', function ($cell) {$cell->setValue('Modal Luar');});
                $sheet->cell('K1', function ($cell) {$cell->setValue('Asset');});
                $sheet->cell('L1', function ($cell) {$cell->setValue('Omset');});
                $sheet->cell('M1', function ($cell) {$cell->setValue('Kegiatan Usaha');});

                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $i = $key + 2;
                        $sheet->cell('A' . $i, $value->ukmtable->lembaga->plut_name);
                        $sheet->cell('B' . $i, $value->ukmtable->id_kumkm);
                        $sheet->cell('C' . $i, $value->ukmtable->nama_usaha);
                        $sheet->cell('D' . $i, $value->ukmtable->alamat);
                        $sheet->cell('E' . $i, $value->ukmtable->tgl_mulai_usaha);
                        $sheet->cell('F' . $i, $value->ukmtable->bidangusaha ? $value->ukmtable->bidangusaha->name : '');
                        $sheet->cell('G' . $i, $value->ukmtable->badan_usaha);
                        $sheet->cell('H' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->jml_tenaga_kerja : '');
                        $sheet->cell('I' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->modal_sendiri : '');
                        $sheet->cell('J' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->modal_hutang : '');
                        $sheet->cell('K' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->asset : '');
                        $sheet->cell('L' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->omset : '');
                        $sheet->cell('M' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->kegiatan_usaha : '');
                    }
                }
            });
        })->download('xlsx');
    }

    public function multipleLock(Request $request)
    {
        $sasaran_umkm_id = $request->sasaran_umkm_id_to_lock;
        $jumlah = 0;
        $gagal = 0;

        if (!$sasaran_umkm_id) {
            return redirect()->back()->with('error', 'Pastikan Memilih Sasaran nya. Harus Teliti lagi ! ');
        }
        foreach ($sasaran_umkm_id as $key => $value) {
            $saprog = SasaranProgram::find($value);
            if ($saprog) {
                $saprog->lock = 'Yes';
                $saprog->save();
                if ($saprog) {
                    $jumlah++;
                }
            } else {
                $gagal++;
            }
        }
        return redirect()->back()->with('info', $jumlah . ' Data Telah Lock, Gagal Sebanyak ' . $gagal);
    }

    public function multipleUnlock(Request $request)
    {
        $sasaran_umkm_id = $request->sasaran_umkm_id_to_unlock;
        $jumlah = 0;
        $gagal = 0;

        if (!$sasaran_umkm_id) {
            return redirect()->back()->with('error', 'Pastikan Memilih Sasaran nya. Harus Teliti lagi ! ');
        }
        foreach ($sasaran_umkm_id as $key => $value) {
            $saprog = SasaranProgram::find($value);
            if ($saprog) {
                $saprog->lock = 'No';
                $saprog->save();
                if ($saprog) {
                    $jumlah++;
                }
            } else {
                $gagal++;
            }
        }
        return redirect()->back()->with('info', $jumlah . ' Data Telah Lock, Gagal Sebanyak ' . $gagal);
    }
}
