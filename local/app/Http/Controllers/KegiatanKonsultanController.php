<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\KegiatanKonsultanRepository;

class KegiatanKonsultanController extends Controller
{
	protected $kegiatan;

	public function __construct(KegiatanKonsultanRepository $kegiatan)
	{
		$this->kegiatan = $kegiatan;
	}

    public function getAll()
    {
    	return $this->kegiatan->getAll();    	
    }
}
