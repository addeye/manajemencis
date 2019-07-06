<?php

namespace App\Http\Controllers\Monev;

use App\Http\Controllers\Controller;
use App\Konsultan;
use Illuminate\Http\Request;
use App\Cis_lembaga;
use Excel;

class KonsultanController extends Controller
{
    public function all(Request $request)
    {
        $konsultan = Konsultan::query();
        $konsultan->whereHas('user', function ($q) {
            $q->where('status', 'aktif');
        });
        if ($request->search) {
            $konsultan->where('nama_lengkap', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->lembaga_id) {
            $konsultan->where('lembaga_id', $request->lembaga_id);
        }

        if ($request->bidang_layanan_id) {
            $konsultan->where('bidang_layanan_id', $request->bidang_layanan_id);
        }

        $konsultan = $konsultan->paginate();
        $data = [
            'title' => 'Data Konsultan',
            'konsultan' => $konsultan,
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get()
        ];
        return view('dashboard.monev.konsultan.list', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Data',
            'data' => Konsultan::findOrFail($id)
        ];
        return view('dashboard.monev.konsultan.detail', $data);
    }

    public function export(Request $request)
    {
        $konsultan = Konsultan::query();
        $nama_lembaga = '';
        $konsultan->whereHas('user', function ($q) {
            $q->where('status', 'aktif');
        });
        if ($request->search) {
            $konsultan->where('nama_lengkap', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->lembaga_id) {
            $lembaga = Cis_lembaga::find($request->lembaga_id);
            $konsultan->where('lembaga_id', $request->lembaga_id);
            $nama_lembaga = $lembaga->plut_name;
        }

        if ($request->bidang_layanan_id) {
            $konsultan->where('bidang_layanan_id', $request->bidang_layanan_id);
        }

        $data = $konsultan->get();

        if ($data->count() == 0) {
            return redirect()->back()->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
        }

        return Excel::create('Data Kosultan ' . $nama_lembaga, function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->cell('A1', function ($cell) {$cell->setValue('No Registrasi');});
                $sheet->cell('B1', function ($cell) {$cell->setValue('Status');});
                $sheet->cell('C1', function ($cell) {$cell->setValue('Nama Lengkap');});
                $sheet->cell('D1', function ($cell) {$cell->setValue('ID Lembaga');});
                $sheet->cell('E1', function ($cell) {$cell->setValue('Lembaga');});
                $sheet->cell('F1', function ($cell) {$cell->setValue('Bidang Layanan');});
                $sheet->cell('G1', function ($cell) {$cell->setValue('Jenis Kelamin');});
                $sheet->cell('H1', function ($cell) {$cell->setValue('Telepon');});
                $sheet->cell('I1', function ($cell) {$cell->setValue('Email');});
                $sheet->cell('J1', function ($cell) {$cell->setValue('Provinsi');});
                $sheet->cell('K1', function ($cell) {$cell->setValue('Kabupaten');});
                $sheet->cell('L1', function ($cell) {$cell->setValue('Alamat');});
                $sheet->cell('M1', function ($cell) {$cell->setValue('Pendidikan Terakhir');});
                $sheet->cell('N1', function ($cell) {$cell->setValue('Nama Sekolah');});
                $sheet->cell('O1', function ($cell) {$cell->setValue('Jurusan/Prodi');});
                $sheet->cell('P1', function ($cell) {$cell->setValue('Kompetensi');});
                $sheet->cell('Q1', function ($cell) {$cell->setValue('Pengalaman');});
                $sheet->cell('R1', function ($cell) {$cell->setValue('Sertifikat');});
                $sheet->cell('S1', function ($cell) {$cell->setValue('Asosiasi');});
                if (!empty($data)) {
                    foreach ($data as $key => $row) {
                        $i = $key + 2;
                        $sheet->cell('A' . $i, $row->no_registrasi);
                        $sheet->cell('B' . $i, $row->user->status);
                        $sheet->cell('C' . $i, $row->nama_lengkap);
                        $sheet->cell('D' . $i, $row->lembagas ? $row->lembagas->id_lembaga : '-');
                        $sheet->cell('E' . $i, $row->lembagas ? $row->lembagas->plut_name : '-');
                        $sheet->cell('F' . $i, $row->lembagas ? $row->lembagas->plut_name : '-');
                        $sheet->cell('G' . $i, $row->jenis_kelamin);
                        $sheet->cell('H' . $i, $row->telepon);
                        $sheet->cell('I' . $i, $row->email);
                        $sheet->cell('J' . $i, $row->provinces->name);
                        $sheet->cell('K' . $i, $row->regencies->name);
                        $sheet->cell('L' . $i, $row->alamat . ' ' . $row->kode_pos);
                        $sheet->cell('M' . $i, $row->pendidikans->name);
                        $sheet->cell('N' . $i, $row->perguruan_terakhir);
                        $sheet->cell('O' . $i, $row->jurusan);
                        $sheet->cell('P' . $i, $row->bidang_keahlian);
                        $sheet->cell('Q' . $i, $row->pengalaman);
                        $sheet->cell('R' . $i, $row->sertifikat);
                        $sheet->cell('S' . $i, $row->asosiasi);
                    }
                }
            });
        })->download('xlsx');
    }
}
