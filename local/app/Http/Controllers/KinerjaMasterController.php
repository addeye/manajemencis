<?php

namespace App\Http\Controllers;

use App\Bidang_layanan;
use App\Cis_lembaga;
use App\KinerjaKeterangan;
use App\KinerjaMaster;
use App\StandartLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KinerjaMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Daftar Kinerja',
            'data' => KinerjaMaster::with('standart_layanan', 'lembaga')->get(),
            'lembaga' => Cis_lembaga::all(),
        ];
        return view('kinerja.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Add/Edit Kinerja',
            'bidanglayanan' => Bidang_layanan::all(),
            // 'standart_layanan' => StandartLayanan::all(),
            'lembaga' => Cis_lembaga::orderBy('id', 'asc')->get(),
        ];
        // return $data;
        return view('kinerja.add', $data);
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

        foreach ($request->standart_layanan_id as $key => $value) {
            if ($request->kinerja_id[$key] != '') {
                $kinerja = KinerjaMaster::find($request->kinerja_id[$key]);
                $kinerja->sasaran = $request->sasaran[$key];
                $kinerja->target = $request->target[$key];
                $kinerja->jan = $request->jan[$key];
                $kinerja->feb = $request->feb[$key];
                $kinerja->mar = $request->mar[$key];
                $kinerja->apr = $request->apr[$key];
                $kinerja->mei = $request->mei[$key];
                $kinerja->jun = $request->jun[$key];
                $kinerja->jul = $request->jul[$key];
                $kinerja->agu = $request->agu[$key];
                $kinerja->sept = $request->sept[$key];
                $kinerja->okt = $request->okt[$key];
                $kinerja->nov = $request->nov[$key];
                $kinerja->des = $request->des[$key];
                $kinerja->update();
            } else {
                $kinerja = new KinerjaMaster();
                $kinerja->cis_lembaga_id = $request->cis_lembaga_id;
                $kinerja->standart_layanan_id = $request->standart_layanan_id[$key];
                $kinerja->tahun = $request->tahun;
                $kinerja->sasaran = $request->sasaran[$key];
                $kinerja->target = $request->target[$key];
                $kinerja->jan = $request->jan[$key];
                $kinerja->feb = $request->feb[$key];
                $kinerja->mar = $request->mar[$key];
                $kinerja->apr = $request->apr[$key];
                $kinerja->mei = $request->mei[$key];
                $kinerja->jun = $request->jun[$key];
                $kinerja->jul = $request->jul[$key];
                $kinerja->agu = $request->agu[$key];
                $kinerja->sept = $request->sept[$key];
                $kinerja->okt = $request->okt[$key];
                $kinerja->nov = $request->nov[$key];
                $kinerja->des = $request->des[$key];
                $kinerja->save();
            }
        }

        return redirect('kinerja-master')->with('success', 'Data Kinerja Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = KinerjaMaster::find($id);
        $data = [
            'title' => 'Edit Kinerja',
            'bidanglayanan' => Bidang_layanan::all(),
            'lembaga' => Cis_lembaga::orderBy('id', 'asc')->get(),
            'standart_layanan' => StandartLayanan::where('bidang_layanan_id', $row->standart_layanan->bidang_layanan->id)->get(),
            'data' => $row,
        ];
        // return $data;
        return view('kinerja.edit', $data);
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
        $kinerja = KinerjaMaster::find($id);
        $kinerja->standart_layanan_id = $request->standart_layanan_id;
        $kinerja->sasaran = $request->sasaran;
        $kinerja->target = $request->target;
        $kinerja->tahun = $request->tahun;
        $kinerja->cis_lembaga_id = $request->cis_lembaga_id;
        $kinerja->jan = $request->jan;
        $kinerja->feb = $request->feb;
        $kinerja->mar = $request->mar;
        $kinerja->apr = $request->apr;
        $kinerja->mei = $request->mei;
        $kinerja->jun = $request->jun;
        $kinerja->jul = $request->jul;
        $kinerja->agu = $request->agu;
        $kinerja->sept = $request->sept;
        $kinerja->okt = $request->okt;
        $kinerja->nov = $request->nov;
        $kinerja->des = $request->des;
        $kinerja->save();

        if ($kinerja) {
            return redirect('kinerja-master')->with('success', 'Data Kinerja Berhasil Diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = KinerjaMaster::find($id);
        $result->delete();
    }

    public function getStandartLayanan($id)
    {
        echo '<option value=""">Pilih Layanan</option>';
        $standart_layanan = StandartLayanan::where('bidang_layanan_id', $id)->get();
        foreach ($standart_layanan as $value) {
            echo '<option value="' . $value->id . '">' . $value->nama . '</option>';
        }
    }

    public function report()
    {
    }

    public function getListStandartLayanan($lembaga_id, $tahun)
    {
        if ($lembaga_id == '') {
            echo 'Data Kosong Tidak Ada Lembaga';
            return false;
        }
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
        $data = [
            'kinerja' => $kinerja,
            'tahun' => $tahun,
            'lembaga_id' => $lembaga_id,
        ];
        return view('kinerja.add_ajax', $data);
    }

    public function getListPerCis($lembaga_id, $tahun)
    {
        // return 'deye';
        if ($lembaga_id == '') {
            echo 'Data Kosong Tidak Ada Lembaga';
            return false;
        }
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

        $row_percent = [];

        foreach ($kinerja as $key => $value) {
            $a = $value->jan ? $value->jan : 0;
            $b = $value->feb ? $value->feb : 0;
            $c = $value->mar ? $value->mar : 0;
            $d = $value->apr ? $value->apr : 0;
            $e = $value->mei ? $value->mei : 0;
            $f = $value->jun ? $value->jun : 0;
            $g = $value->jul ? $value->jul : 0;
            $h = $value->agu ? $value->agu : 0;
            $i = $value->sept ? $value->sept : 0;
            $j = $value->okt ? $value->okt : 0;
            $k = $value->nov ? $value->nov : 0;
            $l = $value->des ? $value->des : 0;
            $x = $value->target ? $value->target : 0;

            $total = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

            $kinerja[$key]->total = $total;

            $predikat = 'Kurang Baik';

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
        ];
        // return $data;
        return view('kinerja.list_ajax', $data);
    }

    public function getRekapForm()
    {
        $data = [
            'title' => 'Rekap Kinerja',
        ];
        return view('kinerja.rekap', $data);
    }

    public function getRekap($tahun)
    {
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
        ];
        return view('kinerja.rekap_ajax', $data);
    }
}
