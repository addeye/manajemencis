<?php

namespace App\Http\Controllers;

use App\Cis_lembaga;
use App\PelaksanaanPendampingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class PelaksanaanPendampinganController extends Controller
{
    public function getList()
    {
        $nama_kumkm = Input::get('nama_kumkm');
        $tahun = Input::get('tahun');
        $tanggal_selesai = Input::get('tanggal_selesai');
        $tanggal_mulai = Input::get('tanggal_mulai');
        $tahun = Input::get('tahun');
        $lembaga_id = Input::get('lembaga_id');

        $content = PelaksanaanPendampingan::query();

        $content->with('program_kerja');

        if (Input::get('nama_kumkm')) {
            $content->where('nama_kumkm', 'like', '%' . $nama_kumkm . '%');
        }

        if (Input::get('tanggal_mulai') && Input::get('tanggal_selesai')) {
            $from = Carbon::createFromFormat('d-m-Y', $tanggal_mulai)->format('Y-m-d');
            $to = Carbon::createFromFormat('d-m-Y', $tanggal_selesai)->format('Y-m-d');
            $content->whereBetween('tanggal', [$from, $to])->orderBy('tanggal');
        }

        if (Input::get('lembaga_id')) {
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
            'tanggal_selesai' => $tanggal_selesai,
            'tanggal_mulai' => $tanggal_mulai,
            'lembaga_id' => $lembaga_id,
            'lembaga' => Cis_lembaga::all(),
        ];
        // return $data;
        return view('pelaksanaan_pendampingan.list', $data);
    }

    public function export()
    {
        $nama_kumkm = Input::get('nama_kumkm');
        $tahun = Input::get('tahun');
        $tanggal_selesai = Input::get('tanggal_selesai');
        $tanggal_mulai = Input::get('tanggal_mulai');
        $tahun = Input::get('tahun');
        $lembaga_id = Input::get('lembaga_id');

        $nama_lembaga = '';

        $content = PelaksanaanPendampingan::query();

        $content->with('program_kerja');

        if (Input::get('nama_kumkm')) {
            $content->where('nama_kumkm', 'like', '%' . $nama_kumkm . '%');
        }

        if (Input::get('tanggal_mulai') && Input::get('tanggal_selesai')) {
            $from = Carbon::createFromFormat('d-m-Y', $tanggal_mulai)->format('Y-m-d');
            $to = Carbon::createFromFormat('d-m-Y', $tanggal_selesai)->format('Y-m-d');
            $content->whereBetween('tanggal', [$from, $to])->orderBy('tanggal');
        }

        if (Input::get('lembaga_id')) {
            $lembaga = Cis_lembaga::find($lembaga_id);
            $nama_lembaga = $lembaga->plu_name;
            $content->where('lembaga_id', $lembaga_id);
        }

        if ($tahun == '') {
            $tahun = date('Y');
        }

        $content->whereYear('tanggal', $tahun);

        $content = $content->get();

        return Excel::create('Kartu Pelaksanaan Pendampingan Koperasi Dan UMK ' . $tahun . '_' . $tanggal_mulai . '-' . $tanggal_selesai . '_' . $nama_lembaga . '_' . date('d-m-Y H:i'), function ($excel) use ($content) {
            $excel->sheet('mySheet', function ($sheet) use ($content) {
                $sheet->cell('A1', function ($cell) {
                    $cell->setValue('Lembaga')->setFont([
                        'bold' => true,
                        'text-align' => 'center',
                        'vertical-align' => 'middle'
                    ]);
                })->mergeCells('A1:A2');
                $sheet->cell('B1', function ($cell) {
                    $cell->setValue('Nama KUMKM')->setFont([
                        'bold' => true,
                        'text-align' => 'center',
                        'vertical-align' => 'middle'
                    ]);
                })->mergeCells('B1:B2');
                $sheet->cell('C1', function ($cell) {
                    $cell->setValue('Identifikasi permasalahan (Per Bidang Layanan)')->setFont([
                        'bold' => true,
                        'text-align' => 'center',
                        'vertical-align' => 'middle'
                    ]);
                })->mergeCells('C1:C2');
                $sheet->cell('D1', function ($cell) {
                    $cell->setValue('Program Kerja Pendampingan')->setFont([
                        'bold' => true,
                        'text-align' => 'center',
                        'vertical-align' => 'middle'
                    ]);
                })->mergeCells('D1:D2');
                $sheet->cell('E1', function ($cell) {
                    $cell->setValue('Pelaksanaan Pendampingan')->setFont([
                        'bold' => true,
                        'text-align' => 'center',
                        'vertical-align' => 'middle'
                    ]);
                })->mergeCells('E1:F1');
                $sheet->cell('E2', function ($cell) {
                    $cell->setValue('Tgl/Bln/Thn')->setFont([
                        'bold' => true,
                        'text-align' => 'center',
                        'vertical-align' => 'middle'
                    ]);
                });
                $sheet->cell('F2', function ($cell) {
                    $cell->setValue('Materi Pendampingan')->setFont([
                        'bold' => true,
                        'text-align' => 'center',
                        'vertical-align' => 'middle'
                    ]);
                });
                $sheet->cell('G1', function ($cell) {
                    $cell->setValue('Skema Tindakan Lebih Lanjut')->setFont([
                        'bold' => true,
                        'text-align' => 'center',
                        'vertical-align' => 'middle'
                    ]);
                })->mergeCells('G1:G2');
                //
                // $sheet->setAllBorders('thin');
                if (!empty($content)) {
                    foreach ($content as $key => $row) {
                        $i = $key + 3;
                        $sheet->cell('A' . $i, $row->lembaga->plut_name);
                        $sheet->cell('B' . $i, $row->nama_kumkm);
                        $sheet->cell('C' . $i, $row->program_kerja->permasalahan);
                        $sheet->cell('D' . $i, $row->program_kerja->proker_pendampingan);
                        $sheet->cell('E' . $i, date('d/m/Y', strtotime($row->tanggal)));
                        $sheet->cell('F' . $i, $row->materi);
                        $sheet->cell('G' . $i, $row->tindak_lanjut);
                    }
                }
            });
        })->download('xlsx');
    }

    public function print()
    {
        $nama_kumkm = Input::get('nama_kumkm');
        $tahun = Input::get('tahun');
        $tanggal_selesai = Input::get('tanggal_selesai');
        $tanggal_mulai = Input::get('tanggal_mulai');
        $tahun = Input::get('tahun');
        $lembaga_id = Input::get('lembaga_id');

        $content = PelaksanaanPendampingan::query();

        $content->with('program_kerja');

        if (Input::get('nama_kumkm')) {
            $content->where('nama_kumkm', 'like', '%' . $nama_kumkm . '%');
        }

        if (Input::get('tanggal_mulai') && Input::get('tanggal_selesai')) {
            $from = Carbon::createFromFormat('d-m-Y', $tanggal_mulai)->format('Y-m-d');
            $to = Carbon::createFromFormat('d-m-Y', $tanggal_selesai)->format('Y-m-d');
            $content->whereBetween('tanggal', [$from, $to])->orderBy('tanggal');
        }

        if (Input::get('lembaga_id')) {
            $content->where('lembaga_id', $lembaga_id);
        }

        if ($tahun == '') {
            $tahun = date('Y');
        }

        $content->whereYear('tanggal', $tahun);

        $content = $content->get();

        $data = [
            'data' => $content,
            'nama_kumkm' => $nama_kumkm,
            'tahun' => $tahun,
            'tanggal_selesai' => $tanggal_selesai,
            'tanggal_mulai' => $tanggal_mulai,
            'lembaga_id' => $lembaga_id,
            'lembaga' => Cis_lembaga::all(),
        ];
        // return $data;
        return view('pelaksanaan_pendampingan.print', $data);
    }

    public function lock(Request $request, $id)
    {
        $statuslock = $request->lock;
        if ($statuslock == 'Yes') {
            $lock = 'No';
        } elseif ($statuslock == 'No') {
            $lock = 'Yes';
        }
        $data = PelaksanaanPendampingan::find($id);
        $data->lock = $lock;
        $data->save();

        if ($data) {
            return redirect('pelaksanaan-pendampingan-konsultan')->with('success', 'Status LOCK menjadi ' . $lock);
        }
    }

    public function multipleLock(Request $request)
    {
        $pelaksanaan_id = $request->pelaksanaan_id_to_lock;
        $jumlah = 0;
        $gagal = 0;

        if (!$pelaksanaan_id) {
            return redirect()->back()->with('error', 'Pastikan Memilih Sasaran nya. Harus Teliti lagi ! ');
        }
        foreach ($pelaksanaan_id as $key => $value) {
            $pel = PelaksanaanPendampingan::find($value);
            if ($pel) {
                $pel->lock = 'Yes';
                $pel->save();
                if ($pel) {
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
        $pelaksanaan_id = $request->pelaksanaan_id_to_unlock;
        $jumlah = 0;
        $gagal = 0;

        if (!$pelaksanaan_id) {
            return redirect()->back()->with('error', 'Pastikan Memilih data nya. Harus Teliti lagi ! ');
        }
        foreach ($pelaksanaan_id as $key => $value) {
            $pel = PelaksanaanPendampingan::find($value);
            if ($pel) {
                $pel->lock = 'No';
                $pel->save();
                if ($pel) {
                    $jumlah++;
                }
            } else {
                $gagal++;
            }
        }
        return redirect()->back()->with('info', $jumlah . ' Data Telah UnLock, Gagal Sebanyak ' . $gagal);
    }

    public function getKumkmByKonsultan($konsultan_id)
    {
        $pp = PelaksanaanPendampingan::where('konsultan_id', $konsultan_id)->get();
        $data = [
            'kumkm' => $pp->unique('kumkm_id')
        ];
        return response()->json(
            [
                'error' => [],
                'status' => true,
                'data' => $data,
                'message' => 'Kumkm tampil'
            ]
        );
    }

    public function getResult(Request $request)
    {
    }
}
