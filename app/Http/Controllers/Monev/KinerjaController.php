<?php

namespace App\Http\Controllers\Monev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\KinerjaKeterangan;
use App\Cis_lembaga;

class KinerjaController extends Controller
{
    public function all(Request $request)
    {
        if (!$request->tahun) {
            $tahun = date('Y');
        } else {
            $tahun = $request->tahun;
        }

        $kinerja = DB::table('standart_layanan')
            ->leftJoin('kinerja_master', function ($leftJoin) use ($tahun) {
                $leftJoin->on('standart_layanan.id', '=', 'kinerja_master.standart_layanan_id')
                    ->where('kinerja_master.tahun', $tahun);
            })
            ->select(
            'standart_layanan.id',
            'standart_layanan.nama',
            DB::raw('sum(kinerja_master.target) as target'),
            DB::raw('sum(kinerja_master.jan) as jan'),
            DB::raw('sum(kinerja_master.feb) as feb'),
            DB::raw('sum(kinerja_master.mar) as mar'),
            DB::raw('sum(kinerja_master.apr) as apr'),
            DB::raw('sum(kinerja_master.mei) as mei'),
            DB::raw('sum(kinerja_master.jun) as jun'),
            DB::raw('sum(kinerja_master.jul) as jul'),
            DB::raw('sum(kinerja_master.agu) as agu'),
            DB::raw('sum(kinerja_master.sept) as sept'),
            DB::raw('sum(kinerja_master.okt) as okt'),
            DB::raw('sum(kinerja_master.nov) as nov'),
            DB::raw('sum(kinerja_master.des) as des')
            )
            ->orderBy('standart_layanan.id')
            ->groupBy('standart_layanan.nama', 'standart_layanan.id')->get();

        foreach ($kinerja as $key => $value) {
            $total = $value->jan + $value->feb + $value->mar + $value->apr + $value->mei + $value->jun + $value->jul + $value->agu + $value->sept + $value->okt + $value->nov + $value->des;
            $kinerja[$key]->total = $total;
            $kinerja[$key]->percent = $total ? $value->target ? ($total / $value->target) * 100 : 0 : 0;
        }
        $data = [
            'kinerja' => $kinerja,
            'tahun' => $tahun
        ];
        return view('dashboard.monev.kinerja.list', $data);
    }

    public function listPerPlut(Request $request)
    {
        $lembaga_id = $request->lembaga_id;
        $tahun = $request->tahun;

        $kinerja = DB::table('standart_layanan')
            ->leftJoin('kinerja_master', function ($leftJoin) use ($lembaga_id, $tahun) {
                $leftJoin->on('standart_layanan.id', '=', 'kinerja_master.standart_layanan_id')
                    ->where('kinerja_master.cis_lembaga_id', $lembaga_id)
                    ->where('kinerja_master.tahun', $tahun);
            })
            ->select(
                'standart_layanan.*',
            'kinerja_master.sasaran',
            'kinerja_master.target',
            'kinerja_master.jan',
            'kinerja_master.feb',
            'kinerja_master.mar',
            'kinerja_master.apr',
            'kinerja_master.mei',
            'kinerja_master.jun',
            'kinerja_master.jul',
            'kinerja_master.agu',
            'kinerja_master.sept',
            'kinerja_master.okt',
            'kinerja_master.nov',
            'kinerja_master.des',
            'kinerja_master.id AS kinerja_id'
            )
            ->orderBy('standart_layanan.id')->get();

        foreach ($kinerja as $key => $value) {
            $a = is_numeric($value->jan) ? $value->jan : 0;
            $a = preg_replace('/\D/', '', $a);
            $b = is_numeric($value->feb) ? $value->feb : 0;
            $b = preg_replace('/\D/', '', $b);
            $c = is_numeric($value->mar) ? $value->mar : 0;
            $c = preg_replace('/\D/', '', $c);
            $d = is_numeric($value->apr) ? $value->apr : 0;
            $d = preg_replace('/\D/', '', $d);
            $e = is_numeric($value->mei) ? $value->mei : 0;
            $e = preg_replace('/\D/', '', $e);
            $f = is_numeric($value->jun) ? $value->jun : 0;
            $f = preg_replace('/\D/', '', $f);
            $g = is_numeric($value->jul) ? $value->jul : 0;
            $g = preg_replace('/\D/', '', $g);
            $h = is_numeric($value->agu) ? $value->agu : 0;
            $h = preg_replace('/\D/', '', $h);
            $i = is_numeric($value->sept) ? $value->sept : 0;
            $i = preg_replace('/\D/', '', $i);
            $j = is_numeric($value->okt) ? $value->okt : 0;
            $j = preg_replace('/\D/', '', $j);
            $k = is_numeric($value->nov) ? $value->nov : 0;
            $k = preg_replace('/\D/', '', $k);
            $l = is_numeric($value->des) ? $value->des : 0;
            $l = preg_replace('/\D/', '', $l);
            $x = is_numeric($value->target) ? $value->target : 0;
            $x = preg_replace('/\D/', '', $x);

            $total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;
            // var_dump($total);

            $kinerja[$key]->total = $total;

            $predikat = 'Kurang Baik';
            $row_percent = [];

            if ($total != 0 && $x != 0) {
                $percent = ($total / $x) * 100;
                $kinerja[$key]->percent = $percent;
            } else {
                $percent = 0;
                $kinerja[$key]->percent = $percent;
            }

            if ($value->target != '' or $value->target != 0) {
                $row_percent[] = $percent;
            }

            if (count($row_percent) > 0) {
                $rata_percent = array_sum($row_percent) / count($row_percent);
            } else {
                $rata_percent = 0;
            }

            if ($rata_percent > 0 && $rata_percent <= 60) {
                $predikat = 'Kurang Baik';
            } elseif ($rata_percent > 60 && $rata_percent <= 80) {
                $predikat = 'Baik';
            } elseif ($rata_percent > 80 && $rata_percent <= 100) {
                $predikat = 'Sangat Baik';
            }

            // $kinerja[$key]->percent = $total ? ($total / $value->target) * 100 : 0;
        }

        $keterangan_kinerja = KinerjaKeterangan::where('cis_lembaga_id', $lembaga_id)->where('tahun', $tahun)->first();

        // return $kinerja;
        $data = [
            'kinerja' => $kinerja,
            'tahun' => $tahun,
            'lembaga_id' => $lembaga_id,
            'rata_percent' => $rata_percent,
            'predikat' => $predikat,
            'keterangan_kinerja' => $keterangan_kinerja,
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get()
        ];
        // return $data;
        return view('dashboard.monev.kinerja.listperplut', $data);
    }
}
