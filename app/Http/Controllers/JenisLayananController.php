<?php

namespace App\Http\Controllers;


use App\Repositories\JenisLayananRepository;
use Illuminate\Http\Request;

class JenisLayananController extends Controller
{
    protected $jenislayanan;

    public function __construct(JenisLayananRepository $jenislayanan)
    {
    	$this->jenislayanan = $jenislayanan;
    }

    public function getAll()
    {
    	$data = array
    	(
    		'title' => 'Data Jenis Layanan',
    		'jenislayanan' => $this->jenislayanan->getAll()

    	);

    	return view('jenis_layanan.list_jenis_layanan' ,$data);
    }
}
