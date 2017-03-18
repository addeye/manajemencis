<?php

namespace App\Http\Controllers;

use App\Repositories\KumkmRepository;
use Illuminate\Http\Request;

class KumkmController extends Controller
{
    protected $kumkm;

    public function __construct(KumkmRepository $kumkmRepository)
    {
        $this->kumkm = $kumkmRepository;
    }
}
