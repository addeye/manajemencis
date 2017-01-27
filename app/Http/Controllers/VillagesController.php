<?php

namespace App\Http\Controllers;

use App\Repositories\VillagesRepository;
use Illuminate\Http\Request;

class VillagesController extends Controller
{
    protected $villages;

    public function __construct(VillagesRepository $villages)
    {
        $this->villages = $villages;
    }

    public function getAll()
    {
        $data = array(
            'title' => 'Data Kelurahan',
            'villages' => $this->villages->getAll()
        );
        return view('villages.list_villages',$data);
    }
}
