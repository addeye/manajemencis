<?php

namespace App\Http\Controllers\Monev;

use App\Http\Controllers\Controller;
use App\Admin_lembaga;

class AdminController extends Controller
{
    public function all()
    {
        $data = [
            'head_title' => 'Admin',
            'title' => 'Data Admin Lembaga',
            'data' => Admin_lembaga::all(),
        ];

        return view('dashboard.monev.admin.list', $data);
    }
}
