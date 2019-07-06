<?php

namespace App\Http\Controllers\Monev;

use App\Http\Controllers\Controller;
use App\Sentra_kumkm;
use Illuminate\Http\Request;
use App\Cis_lembaga;

class SentraController extends Controller
{
    public function all(Request $request)
    {
        $sentra = Sentra_kumkm::query();

        if ($request->has('search')) {
            $sentra->where('name', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->has('lembaga_id')) {
            $sentra->where('id_lembaga', $request->lembaga_id);
        }

        $sentra = $sentra->paginate();

        $data = [
            'head_title' => 'Sentra UMKM',
            'title' => 'Data Sentra UMKM',
            'lembaga' => Cis_lembaga::orderBy('id_lembaga', 'ASC')->get(),
            'data' => $sentra,
        ];
        return view('dashboard.monev.sentra.list', $data);
    }

    public function detail($id)
    {
        $data = [
            'head_title' => 'Sentra UMKM',
            'title' => 'Edit Data Sentra UMKM',
            'data' => Sentra_kumkm::findOrFail($id)
        ];

        return view('dashboard.monev.sentra.show', $data);
    }
}
