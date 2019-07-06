<?php

namespace App\Http\Controllers\Monev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProdukUnggulan;

class ProdukController extends Controller
{
    public function all(Request $request)
    {
        $produk = ProdukUnggulan::query();
        if ($request->has('search')) {
            $produk->where('nama_produk', 'LIKE', '%' . $request->search . '%');
        }
        $produk = $produk->paginate();
        $data = [
            'head_title' => 'Data Produk Unggulan',
            'title' => 'Data Produk Unggulan',
            'data' => $produk
        ];

        return view('dashboard.monev.produk.list', $data);
    }

    public function detail($id)
    {
    }
}
