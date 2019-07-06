<?php

namespace App\Http\Controllers\Monev;

use App\Http\Controllers\Controller;
use App\Cis_lembaga;

class LembagaController extends Controller
{
    public function getAll()
    {
        $data = [
            'head_title' => 'Lembaga',
            'title' => 'Data Lembaga',
            'data' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get(),
        ];

        return view('dashboard.monev.lembaga.list', $data);
    }

    public function detail($id)
    {
        $data = [
            'head_title' => 'Lembaga',
            'title' => 'Detail Lembaga',
            'data' => Cis_lembaga::findOrFail($id),
        ];

        return view('dashboard.monev.lembaga.detail', $data);
    }

    public function getAllColumn()
    {
    }
}
