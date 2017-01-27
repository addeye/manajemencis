<?php

namespace App\Http\Controllers;

use App\Repositories\DistrictsRepository;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    protected $districts;

    public function __construct(DistrictsRepository $districts)
    {
        $this->districts = $districts;
    }

    public function getAll()
    {
        $data = array(
            'title' => 'Data Kecamatan',
            'districts' => $this->districts->getAll()
        );
        return view('districts.list_districts',$data);
    }
}
