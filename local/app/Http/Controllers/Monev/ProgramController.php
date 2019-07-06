<?php

namespace App\Http\Controllers\Monev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProgramKerja;
use App\SasaranProgram;
use App\Cis_lembaga;
use App\Bidang_layanan;

class ProgramController extends Controller
{
    public function all(Request $request)
    {
        $sasaran_program_id = $request->sasaran_program_id;
        $lembaga_id = $request->lembaga_id;

        $content = ProgramKerja::query();

        $content->with('sasaran_program');

        if ($sasaran_program_id) {
            $content->where('sasaran_program_id', $sasaran_program_id);
        }

        if ($lembaga_id) {
            $content->where('lembaga_id', $lembaga_id);
        }

        $content = $content->paginate();

        $data = [
            'sasaran_program' => SasaranProgram::with('ukmtable')->where('lembaga_id', $lembaga_id)->get(),
            'data' => $content,
            'sasaran_program_id' => $sasaran_program_id,
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get(),
            'lembaga_id' => $lembaga_id,
        ];
        // return $data;
        return view('dashboard.monev.program.list', $data);
    }

    public function rekapPerBidang(Request $request)
    {
        $lembaga_id = $request->lembaga_id;

        $data = Cis_lembaga::orderBy('id_lembaga', 'ASC')->get();

        $bdl = Bidang_layanan::all();

        $data = [
            'data' => $data,
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get(),
            'lembaga_id' => $lembaga_id,
            'bidang_layanan' => $bdl
        ];
        // return $data;
        return view('dashboard.monev.program.rekap_perbidang', $data);
    }
}
