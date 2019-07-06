<?php

namespace App\Http\Controllers\Monev;

use App\Http\Controllers\Controller;
use App\Pengelolah;

class PengelolaController extends Controller
{
    public function all()
    {
        $data = [
            'data' => Pengelolah::all()
        ];
        return view('dashboard.monev.pengelola.list', $data);
    }
}
