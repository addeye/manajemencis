<?php

namespace App\Http\Controllers\Konsultan;

use App\Http\Controllers\Controller;
use App\Koperasi;
use App\SasaranProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\ProgramKerja;

class SasaranProgramKoperasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $tahun = Input::get('tahun');

        $content = SasaranProgram::query();

        $content->with(['ukmtable' => function ($q) {
            $q->with(['koperasi_detail' => function ($q) {
                $q->orderBy('created_at', 'desc');
            }]);
        }])->where('lembaga_id', $user->konsultans->lembaga_id)->where('ukmtable_type', 'koperasi');

        if ($tahun == '') {
            $tahun = date('Y');
        }

        $content->where('tahun', $tahun);

        $content = $content->paginate();

        $data = [
            'data' => $content,
            'tahun' => $tahun,
        ];
        // return $data;

        return view('dashboard.konsultan.sasaran_koperasi.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nama = Input::get('nama');
        $user = Auth::user();

        $tahun = date('Y');

        $koperasi_id = SasaranProgram::where('tahun', $tahun)->where('lembaga_id', $user->konsultans->lembaga_id)->where('ukmtable_type', 'koperasi')->pluck('ukmtable_id');

        $content = Koperasi::query();

        $content->with(['koperasi_detail' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->whereNotIn('id', $koperasi_id)->where('lembaga_id', $user->konsultans->lembaga_id);

        if ($nama) {
            $content->where('nama_koperasi', 'like', '%' . $nama . '%');
        }

        $content = $content->paginate();

        $data = [
            'data' => $content,
            'nama' => $nama,
        ];

        // return $data;

        return view('dashboard.konsultan.sasaran_koperasi.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $user = Auth::user();
        $lembaga_id = $user->konsultans->lembaga_id;

        $tahun = date('Y');
        $koperasi_id = $request->koperasi_id;
        $tgl_keadaan = date('Y-m-d');

        $jml = 0;
        $gagal = 0;

        if (!$koperasi_id) {
            return redirect('sasaran-koperasi/create')->with('error', 'Pastikan data koperasi yang akan dipilih sudah di centang ! ');
        }

        foreach ($koperasi_id as $key => $value) {
            $koperasi = Koperasi::find($value);
            $detail_koperasi = $koperasi->koperasi_detail->count();

            $check = SasaranProgram::where('tahun', $tahun)->where('ukmtable_id', $value)->where('ukmtable_type', 'koperasi')->count();

            if ($check == 0 && $detail_koperasi != 0) {
                $sasaran_program = new SasaranProgram();
                $sasaran_program->tahun = $tahun;
                $sasaran_program->tgl_keadaan = $tgl_keadaan;
                $sasaran_program->lembaga_id = $lembaga_id;
                $sasaran_program->ukmtable_id = $value;
                $sasaran_program->ukmtable_type = 'koperasi';
                $sasaran_program->save();
                $jml++;
            } else {
                $gagal++;
            }
        }

        return redirect('sasaran-koperasi/create')->with('info', $jml . ' Data Masuk, Gagal Sebanyak ' . $gagal);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'data' => SasaranProgram::find($id),
        ];

        return view('dashboard.konsultan.sasaran_koperasi.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'data' => SasaranProgram::find($id),
        ];
        return view('dashboard.konsultan.sasaran_koperasi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sasaran_program = SasaranProgram::find($id);

        $programkerja_count = ProgramKerja::where('sasaran_program_id', $id)->count();
        if ($programkerja_count != 0) {
            return redirect('sasaran-koperasi')->with('error', 'Data Koperasi Sudah Terdaftar Sebagai Program Kerja. Hapus Dari Program Kerja Dahulu atau Hubungi Admin Kemenkop');
        }

        $sasaran_program->delete();
        if ($sasaran_program) {
            return redirect('sasaran-koperasi')->with('success', 'Data telah dihapus');
        }
    }

    public function daftar($id)
    {
        $user = Auth::user();
        $lembaga_id = $user->konsultans->lembaga_id;

        $tgl_keadaan = date('Y-m-d');
        $tahun = date('Y');

        $check = SasaranProgram::where('tahun', $tahun)->where('ukmtable_id', $id)->where('ukmtable_type', 'koperasi');

        if ($check->count()) {
            return redirect('sasaran-koperasi/create')->with('error', 'Maaf data sudah ada');
        }

        $koperasi = Koperasi::find($id);

        if ($koperasi->koperasi_detail->count() == 0) {
            return redirect('sasaran-koperasi/create')->with('error', 'Koperasi tidak memiliki detail data terakhir');
        }

        $sasaran_program = new SasaranProgram();
        $sasaran_program->tahun = $tahun;
        $sasaran_program->tgl_keadaan = $tgl_keadaan;
        $sasaran_program->lembaga_id = $lembaga_id;
        $sasaran_program->ukmtable_id = $id;
        $sasaran_program->ukmtable_type = 'koperasi';
        $sasaran_program->save();

        if ($sasaran_program) {
            return redirect('sasaran-koperasi/create')->with('success', 'Data Koperasi Telah Terdaftar');
        }
    }

    public function lock($id)
    {
        $sasaran_program = SasaranProgram::find($id);
        $sasaran_program->lock = 'Yes';
        $sasaran_program->save();

        if ($sasaran_program) {
            return redirect('sasaran-koperasi')->with('success', 'Data Koperasi Di Lock');
        }
    }

    public function laporan()
    {
        $user = Auth::user();

        $tahun = Input::get('tahun');

        $content = SasaranProgram::query();

        $content->with('ukmtable')->where('lembaga_id', $user->konsultans->lembaga_id)->where('ukmtable_type', 'koperasi');

        if ($tahun == '') {
            $tahun = date('Y');
        }

        $content->where('tahun', $tahun);

        $content = $content->paginate();

        $data = [
            'data' => $content,
            'tahun' => $tahun,
        ];

        // return $data;

        return view('dashboard.konsultan.sasaran_koperasi.laporan', $data);
    }

    public function export()
    {
        $user = Auth::user();

        $tahun = Input::get('tahun');

        $content = SasaranProgram::query();

        $content->with('ukmtable')->where('lembaga_id', $user->konsultans->lembaga_id)->where('ukmtable_type', 'koperasi');

        if ($tahun == '') {
            $tahun = date('Y');
        }

        $content->where('tahun', $tahun);

        $data = $content->get();

        if ($data->count() == 0) {
            return redirect('sasaran-koperasi-laporan')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
        }

        return Excel::create('Sasaran Program Koperasi ' . $tahun, function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->cell('A1', function ($cell) {$cell->setValue('ID Koperasi');});
                $sheet->cell('B1', function ($cell) {$cell->setValue('Nama Koperasi');});
                $sheet->cell('C1', function ($cell) {$cell->setValue('Alamat');});
                $sheet->cell('D1', function ($cell) {$cell->setValue('Nomor dan Tanggal Badan Hukum');});
                $sheet->cell('E1', function ($cell) {$cell->setValue('Jenis Koperasi');});
                $sheet->cell('F1', function ($cell) {$cell->setValue('Tanggal RAT Tahun Buku');});
                $sheet->cell('G1', function ($cell) {$cell->setValue('Anggota');});
                $sheet->cell('H1', function ($cell) {$cell->setValue('Karyawan');});
                $sheet->cell('I1', function ($cell) {$cell->setValue('Asset');});
                $sheet->cell('J1', function ($cell) {$cell->setValue('Modal Sendiri');});
                $sheet->cell('K1', function ($cell) {$cell->setValue('Modal Luar');});
                $sheet->cell('L1', function ($cell) {$cell->setValue('Volume Usaha');});
                $sheet->cell('M1', function ($cell) {$cell->setValue('Sisa Hasil Usaha');});
                $sheet->cell('N1', function ($cell) {$cell->setValue('Kegiatan Usaha');});
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $i = $key + 2;
                        $sheet->cell('A' . $i, $value->ukmtable->id_koperasi);
                        $sheet->cell('B' . $i, $value->ukmtable->nama_koperasi);
                        $sheet->cell('C' . $i, $value->ukmtable->alamat);
                        $sheet->cell('D' . $i, $value->ukmtable->nomor_badan_hukum . ' / ' . $value->ukmtable->tgl_badan_hukum);
                        $sheet->cell('E' . $i, $value->ukmtable->jenis_koperasi);
                        $sheet->cell('F' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->tgl_rat_tahun_buku : '');
                        $sheet->cell('G' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_anggota : '');
                        $sheet->cell('H' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_karyawan : '');
                        $sheet->cell('I' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_asset : '');
                        $sheet->cell('J' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_modal_sendiri : '');
                        $sheet->cell('K' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->jml_modal_luar : '');
                        $sheet->cell('L' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->valume_usaha : '');
                        $sheet->cell('M' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->sisa_hasil : '');
                        $sheet->cell('N' . $i, isset($value->ukmtable->koperasi_detail[0]) ? $value->ukmtable->koperasi_detail[0]->kegiatan_usaha : '');
                    }
                }
            });
        })->download('xlsx');
    }
}
