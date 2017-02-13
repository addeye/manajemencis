<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 10/02/2017
 * Time: 1:26
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\SentraKumkmRepository;

class SentraController extends Controller
{
    protected $sentra;

    public function __construct(SentraKumkmRepository $sentra)
    {
        $this->sentra = $sentra;
    }

    public function getAll()
    {
        $data = array(
            'head_title' => 'Sentra KUMKM',
            'title' => 'Data Sentra KUMKM',
            'data' => $this->sentra->getSentraByAdmin()
        );

        return view('dashboad.admin.sentra.list',$data);
    }

}