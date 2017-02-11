<?php

namespace App\Http\Controllers;

use App\Repositories\CisFilemanagerRepository;
use Illuminate\Http\Request;

class CisFilemanagerController extends Controller
{
    protected $cisfilemanager;

    public function __construct(CisFilemanagerRepository $cisFilemanagerRepository)
    {
        $this->cisfilemanager = $cisFilemanagerRepository;
    }

    public function editData($id)
    {
        $data = array
        (
            'head_title' => 'CIS PLUT-KUMKM',
            'title' => 'Edit CIS PLUT-KUMKM',
            'data' => $this->cisfilemanager->getById($id)
        );
    }
}
