<?php

namespace App\Http\Controllers;


use App\Repositories\BidangUsahaRepository;
use Illuminate\Http\Request;

class BidangUsahaController extends Controller
{
    protected $bidangusaha;

    public function __construct(BidangUsahaRepository $bidangusaha)
    {
    	$this->bidangusaha = $bidangusaha;
    }

    public function getAll()
    {
    	$data = array
    	(
    		'title' => 'Data Bidang Usaha',
    		'bidangusaha' => $this->bidangusaha->getAll()
    	);

    	return view('bidang_usaha.list_bidang_usaha', $data);
    }
}
