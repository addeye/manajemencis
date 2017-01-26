<?php

namespace App\Http\Controllers;

use App\Repositories\ProvincesRepository;
use Illuminate\Http\Request;

class ProvincesController extends Controller
{
    protected $provinces;

    public function __construct(ProvincesRepository $provinces)
    {
        $this->provinces = $provinces;
    }

    public function getAll()
    {
        return $this->provinces->getAll();
    }
}
