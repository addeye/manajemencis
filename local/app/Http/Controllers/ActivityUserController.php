<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivityLog;
use App\User;
use App\Roles;
use App\Cis_lembaga;
use App\Bidang_layanan;
use Maatwebsite\Excel\Facades\Excel;

class ActivityUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'data' => ActivityLog::with('user')->orderBy('created_at','DESC')->get()
        ];

        return view('activity_user.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    public function loginLast(Request $request)
    {
        $content = User::query();

        $content->whereHas('log', function($q){$q->where('info','Melakukan login')->orderBy('created_at','DESC');});

        if($request->has('role'))
        {
            $content->where('role_id',$request->role);
        }

        if($request->has('lembaga'))
        {
            $lembagaselect = $request->lembaga;
            if($request->has('role'))
            {
                if($request->role == 2)
                {
                    $content->whereHas('adminlembagas',function($q) use ($lembagaselect){
                        $q->where('lembaga_id',$lembagaselect);
                    });
                }
                elseif($request->role == 3)
                {
                    $content->whereHas('konsultans',function($q) use ($lembagaselect){
                        $q->where('lembaga_id',$lembagaselect);
                    });
                }
            }
        }

        if($request->has('bidang'))
        {
            $bidang = $request->bidang;
            if($request->has('role'))
            {
                if($request->role == 3)
                {
                    $content->whereHas('konsultans',function($q) use ($bidang){
                        $q->where('bidang_layanan_id',$bidang);
                    });
                }
            }
        }

        $user = $content->paginate();

        $data = [
            'data' => $user,
            'role' => Roles::all(),
            'bidang' => Bidang_layanan::all(),
            'lembaga' => Cis_lembaga::orderBy('id_lembaga')->get()
        ];

        return view('activity_user.loginlast',$data);
    }

    public function loginLastExport(Request $request)
    {
        $content = User::query();

        $content->whereHas('log', function($q){$q->where('info','Melakukan login')->orderBy('created_at','DESC');});

        if($request->has('role'))
        {
            $content->where('role_id',$request->role);
        }

        if($request->has('lembaga'))
        {
            $lembagaselect = $request->lembaga;
            if($request->has('role'))
            {
                if($request->role == 2)
                {
                    $content->whereHas('adminlembagas',function($q) use ($lembagaselect){
                        $q->where('lembaga_id',$lembagaselect);
                    });
                }
                elseif($request->role == 3)
                {
                    $content->whereHas('konsultans',function($q) use ($lembagaselect){
                        $q->where('lembaga_id',$lembagaselect);
                    });
                }
            }
        }

        if($request->has('bidang'))
        {
            $bidang = $request->bidang;
            if($request->has('role'))
            {
                if($request->role == 3)
                {
                    $content->whereHas('konsultans',function($q) use ($bidang){
                        $q->where('bidang_layanan_id',$bidang);
                    });
                }
            }
        }

        $data = $content->get();
        $namefile = date('d-m-Y').' Data Login Terakhir';

        return Excel::create($namefile, function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->cell('A1', function ($cell) {$cell->setValue('Nama')->setAlignment('center');});
                $sheet->cell('B1', function ($cell) {$cell->setValue('Lembaga')->setAlignment('center');});
                $sheet->cell('C1', function ($cell) {$cell->setValue('Jenis Akun')->setAlignment('center');});
                $sheet->cell('D1', function ($cell) {$cell->setValue('Bidang')->setAlignment('center');});
                $sheet->cell('E1', function ($cell) {$cell->setValue('Login Terakhir')->setAlignment('center');});
                if (!empty($data)) {
                    foreach ($data as $key => $row) {
                        $lembaga = '-';
                        $bidang = '-';
                        if($row->role_id==2){
                            $lembaga = $row->adminlembagas->lembagas->plut_name;
                        }elseif($row->role_id==3){
                            $lembaga = $row->konsultans->lembagas->plut_name;
                            $bidang = $row->konsultans->bidang_layanans->name;
                        }
                        $i = $key + 2;
                        $sheet->cell('A' . $i, $row->name);
                        $sheet->cell('B' . $i, $lembaga);
                        $sheet->cell('C' . $i, $row->roles->name);
                        $sheet->cell('D' . $i, $bidang);
                        $sheet->cell('E' . $i, $row->log->last()->created_at->format('d-m-Y H:i:s'));
                    }
                }
            });
        })->download('xlsx');
    }
}
