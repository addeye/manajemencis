<?php

namespace App\Http\Controllers\Konsultan;

use App\Http\Controllers\Controller;
use App\Kumkm;
use App\SasaranProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\ProgramKerja;

class SasaranProgramUmkmController extends Controller
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
            $q->with(['kumkm_detail' => function ($q) {
                $q->orderBy('created_at', 'desc');
            }]);
        }])->where('lembaga_id', $user->konsultans->lembaga_id)->where('ukmtable_type', 'kumkm');

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

        return view('dashboard.konsultan.sasaran_kumkm.list', $data);
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

        $kumkm_id = SasaranProgram::where('tahun', $tahun)->where('lembaga_id', $user->konsultans->lembaga_id)->where('ukmtable_type', 'kumkm')->pluck('ukmtable_id');

        $content = Kumkm::query();

        $content->with(['kumkm_detail' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->whereNotIn('id', $kumkm_id)->where('lembaga_id', $user->konsultans->lembaga_id);

        if ($nama) {
            $content->where('nama_usaha', 'like', '%' . $nama . '%');
        }

        $content = $content->paginate();

        $data = [
            'data' => $content,
            'nama' => $nama,
        ];

        // return $data;

        return view('dashboard.konsultan.sasaran_kumkm.add', $data);
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
        $kumkm_id = $request->kumkm_id;
        $tgl_keadaan = date('Y-m-d', strtotime($request->tgl_keadaan));

        $jml = 0;
        $gagal = 0;

        if (!$kumkm_id) {
            return redirect('sasaran-kumkm/create')->with('error', 'Pastikan data UMKM yang akan dipilih sudah di centang ! ');
        }

        if ($kumkm_id) {
            foreach ($kumkm_id as $key => $value) {
                $kumkm = Kumkm::find($value);
                $detail_kumkm = $kumkm->kumkm_detail->count();

                $check = SasaranProgram::where('tahun', $tahun)->where('ukmtable_id', $value)->where('ukmtable_type', 'kumkm')->count();

                if ($check == 0 && $detail_kumkm != 0) {
                    $sasaran_program = new SasaranProgram();
                    $sasaran_program->tahun = $tahun;
                    $sasaran_program->tgl_keadaan = $tgl_keadaan;
                    $sasaran_program->lembaga_id = $lembaga_id;
                    $sasaran_program->ukmtable_id = $value;
                    $sasaran_program->ukmtable_type = 'kumkm';
                    $sasaran_program->save();
                    $jml++;
                } else {
                    $gagal++;
                }
            }
        }

        return redirect('sasaran-kumkm/create')->with('info', $jml . ' Data Masuk, Gagal Sebanyak ' . $gagal);
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

        return view('dashboard.konsultan.sasaran_kumkm.show', $data);
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
        return view('dashboard.konsultan.sasaran_kumkm.edit', $data);
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
            return redirect('sasaran-kumkm')->with('error', 'Data UMKM Sudah Terdaftar Sebagai Program Kerja. Hapus Dari Program Kerja Dahulu atau Hubungi Admin Kemenkop');
        }

        $sasaran_program->delete();
        if ($sasaran_program) {
            return redirect('sasaran-kumkm')->with('success', 'Data telah dihapus');
        }
    }

    public function daftar($id)
    {
        $user = Auth::user();
        $lembaga_id = $user->konsultans->lembaga_id;

        $tgl_keadaan = date('Y-m-d');
        $tahun = date('Y');

        $check = SasaranProgram::where('tahun', $tahun)->where('ukmtable_id', $id)->where('ukmtable_type', 'kumkm');

        if ($check->count()) {
            return redirect('sasaran-kumkm/create')->with('error', 'Maaf data sudah ada');
        }

        $kumkm = Kumkm::find($id);

        if ($kumkm->kumkm_detail->count() == 0) {
            return redirect('sasaran-kumkm/create')->with('error', 'Kumkm tidak memiliki detail data terakhir');
        }

        $sasaran_program = new SasaranProgram();
        $sasaran_program->tahun = $tahun;
        $sasaran_program->tgl_keadaan = $tgl_keadaan;
        $sasaran_program->lembaga_id = $lembaga_id;
        $sasaran_program->ukmtable_id = $id;
        $sasaran_program->ukmtable_type = 'kumkm';
        $sasaran_program->save();

        if ($sasaran_program) {
            return redirect('sasaran-kumkm/create')->with('success', 'Data UMKM Telah Terdaftar');
        }
    }

    public function lock($id)
    {
        $sasaran_program = SasaranProgram::find($id);
        $sasaran_program->lock = 'Yes';
        $sasaran_program->save();

        if ($sasaran_program) {
            return redirect('sasaran-kumkm')->with('success', 'Data UMKM Di Lock');
        }
    }

    public function laporan()
    {
        $user = Auth::user();

        $tahun = Input::get('tahun');

        $content = SasaranProgram::query();

        $content->with('ukmtable')->where('lembaga_id', $user->konsultans->lembaga_id)->where('ukmtable_type', 'kumkm');

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

        return view('dashboard.konsultan.sasaran_kumkm.laporan', $data);
    }

    public function export()
    {
        $user = Auth::user();

        $tahun = Input::get('tahun');

        $content = SasaranProgram::query();

        $content->where('lembaga_id', $user->konsultans->lembaga_id)->where('ukmtable_type', 'kumkm');

        if ($tahun == '') {
            $tahun = date('Y');
        }

        $content->where('tahun', $tahun);

        $data = $content->get();

        if ($data->count() == 0) {
            return redirect('sasaran-kumkm-laporan')->with('error', 'Data Kosong tidak dapat di Export Silahkan Isi DULU BOSS !!');
        }

        return Excel::create('Sasaran Program UMKM ' . $tahun, function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->cell('A1', function ($cell) {$cell->setValue('ID UMKM');});
                $sheet->cell('B1', function ($cell) {$cell->setValue('Nama UMKM');});
                $sheet->cell('C1', function ($cell) {$cell->setValue('Alamat');});
                $sheet->cell('D1', function ($cell) {$cell->setValue('Tahun Mulai Usaha');});
                $sheet->cell('E1', function ($cell) {$cell->setValue('Jenis Usaha');});
                $sheet->cell('F1', function ($cell) {$cell->setValue('Legalitas');});
                $sheet->cell('G1', function ($cell) {$cell->setValue('Tenaga Kerja (Orang)');});
                $sheet->cell('H1', function ($cell) {$cell->setValue('Modal Sendiri');});
                $sheet->cell('I1', function ($cell) {$cell->setValue('Modal Luar');});
                $sheet->cell('J1', function ($cell) {$cell->setValue('Asset');});
                $sheet->cell('K1', function ($cell) {$cell->setValue('Omset');});
                $sheet->cell('L1', function ($cell) {$cell->setValue('Kegiatan Usaha');});

                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $i = $key + 2;
                        $sheet->cell('A' . $i, $value->ukmtable->id_kumkm);
                        $sheet->cell('B' . $i, $value->ukmtable->nama_usaha);
                        $sheet->cell('C' . $i, $value->ukmtable->alamat);
                        $sheet->cell('D' . $i, $value->ukmtable->tgl_mulai_usaha);
                        $sheet->cell('E' . $i, $value->ukmtable->bidangusaha ? $value->ukmtable->bidangusaha->name : '');
                        $sheet->cell('F' . $i, $value->ukmtable->badan_usaha);
                        $sheet->cell('G' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->jml_tenaga_kerja : '');
                        $sheet->cell('H' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->modal_sendiri : '');
                        $sheet->cell('I' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->modal_hutang : '');
                        $sheet->cell('J' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->asset : '');
                        $sheet->cell('K' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->omset : '');
                        $sheet->cell('L' . $i, isset($value->ukmtable->kumkm_detail[0]) ? $value->ukmtable->kumkm_detail[0]->kegiatan_usaha : '');
                    }
                }
            });
        })->download('xlsx');
    }
}
