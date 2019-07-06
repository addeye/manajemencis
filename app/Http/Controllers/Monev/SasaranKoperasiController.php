<?php

namespace App\Http\Controllers\Monev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SasaranProgram;
use App\Cis_lembaga;
use Maatwebsite\Excel\Facades\Excel;

class SasaranKoperasiController extends Controller
{
    public function all(Request $request)
    {
        $tahun = $request->tahun;
        $lembaga_id = $request->lembaga_id;

        $content = SasaranProgram::query();

        $content->with('ukmtable')->where('ukmtable_type', 'koperasi');

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

        return view('dashboard.monev.sasaran.koperasi.list', $data);
    }

    public function export(Request $request)
    {
        $tahun = $request->tahun;
        $lembaga_id = $request->lembaga_id;

        $nama_lembaga = '';

        $content = SasaranProgram::query();

        $content->with('ukmtable')->where('ukmtable_type', 'koperasi');

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
            return redirect('sasaran-program-koperasi')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
        }

        return Excel::create('Sasaran Program Koperasi ' . $nama_lembaga . ' ' . $tahun, function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->cell('A1', function ($cell) {$cell->setValue('Lembaga');});
                $sheet->cell('B1', function ($cell) {$cell->setValue('ID Koperasi');});
                $sheet->cell('C1', function ($cell) {$cell->setValue('Nama Koperasi');});
                $sheet->cell('D1', function ($cell) {$cell->setValue('Alamat');});
                $sheet->cell('E1', function ($cell) {$cell->setValue('Nomor dan Tanggal Badan Hukum');});
                $sheet->cell('F1', function ($cell) {$cell->setValue('Jenis Koperasi');});
                $sheet->cell('G1', function ($cell) {$cell->setValue('Tanggal RAT Tahun Buku');});
                $sheet->cell('H1', function ($cell) {$cell->setValue('Anggota');});
                $sheet->cell('I1', function ($cell) {$cell->setValue('Karyawan');});
                $sheet->cell('J1', function ($cell) {$cell->setValue('Asset');});
                $sheet->cell('K1', function ($cell) {$cell->setValue('Modal Sendiri');});
                $sheet->cell('L1', function ($cell) {$cell->setValue('Modal Luar');});
                $sheet->cell('M1', function ($cell) {$cell->setValue('Volume Usaha');});
                $sheet->cell('N1', function ($cell) {$cell->setValue('Sisa Hasil Usaha');});
                $sheet->cell('O1', function ($cell) {$cell->setValue('Kegiatan Usaha');});
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $i = $key + 2;
                        $sheet->cell('A' . $i, $value->ukmtable->lembaga->plut_name);
                        $sheet->cell('B' . $i, $value->ukmtable->id_koperasi);
                        $sheet->cell('C' . $i, $value->ukmtable->nama_koperasi);
                        $sheet->cell('D' . $i, $value->ukmtable->alamat);
                        $sheet->cell('E' . $i, $value->ukmtable->nomor_badan_hukum . ' / ' . $value->ukmtable->tgl_badan_hukum);
                        $sheet->cell('F' . $i, $value->ukmtable->jenis_koperasi);
                        $sheet->cell('G' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->tgl_rat_tahun_buku : '');
                        $sheet->cell('H' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_anggota : '');
                        $sheet->cell('I' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_karyawan : '');
                        $sheet->cell('J' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_asset : '');
                        $sheet->cell('K' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_modal_sendiri : '');
                        $sheet->cell('L' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_modal_luar : '');
                        $sheet->cell('M' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->valume_usaha : '');
                        $sheet->cell('N' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->sisa_hasil : '');
                        $sheet->cell('O' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->kegiatan_usaha : '');
                    }
                }
            });
        })->download('xlsx');
    }
}
