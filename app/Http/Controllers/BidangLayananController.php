<?php

namespace App\Http\Controllers;


use App\Repositories\BidangLayananRepository;
use Illuminate\Http\Request;

class BidangLayananController extends Controller
{
    protected $bidanglayanan;

    public function __construct(BidangLayananRepository $bidanglayanan)
    {
    	$this->bidanglayanan = $bidanglayanan;
    }

    public function getAll()
    {
    	$data = Array
    	(
    		'title' => 'Data Bidang Layanan',
    		'bidanglayanan' => $this->bidanglayanan->getAll()

    	);
    	return view('bidang_layanan.list_bidang_layanan',$data);
    }

}
