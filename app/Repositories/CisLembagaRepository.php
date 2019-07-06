<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 10/02/2017
 * Time: 15:00
 */

namespace App\Repositories;

use App\Admin_lembaga;
use App\Cis_lembaga;
use App\Kegiatan_konsultan;
use App\Pengelolah;
use Illuminate\Support\Facades\Auth;

class CisLembagaRepository
{
    protected $cislembaga;
    protected $adminlembaga;
    protected $kegiatan;
    protected $pengelolah;

    public function __construct(
        Cis_lembaga $cis_lembaga,
        Admin_lembaga $admin_lembaga,
        Kegiatan_konsultan $kegiatan_konsultan,
        Pengelolah $pengelolah
    ) {
        $this->cislembaga = $cis_lembaga;
        $this->adminlembaga = $admin_lembaga;
        $this->kegiatan = $kegiatan_konsultan;
        $this->pengelolah = $pengelolah;
    }

    public function getAll()
    {
        return $this->cislembaga->orderBy('id_lembaga', 'ASC')->get();
    }

    public function getById($id)
    {
        return $this->cislembaga->find($id);
    }

    public function create($data = [])
    {
        $result = $this->cislembaga->create($data);
        if ($result) {
            return true;
        }

        return false;
    }

    public function update($id, $data = [])
    {
        $result = $this->cislembaga->find($id)->update($data);
        if ($result) {
            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->cislembaga->destroy($id);
        if ($result) {
            return true;
        }

        return false;
    }

    public function getLembagaForAdmin()
    {
        $user_id = Auth::user()->id;
        $admin = $this->adminlembaga->where('user_id', $user_id)->first();
        $lembaga_id = $admin->lembaga_id;
        return $this->cislembaga->find($lembaga_id);
    }

    public function getLembagaForPengelolah()
    {
        $user_id = Auth::user()->id;
        $pengelolah = $this->pengelolah->where('user_id', $user_id)->first();
        $lembaga_id = $pengelolah->lembaga_id;
        return $this->cislembaga->find($lembaga_id);
    }

    public function getLembagaForKonsultan()
    {
        $lembaga_id = Auth::user()->konsultans->lembaga_id;
        return $this->cislembaga->find($lembaga_id);
    }

    public function getKegiatanById($id)
    {
        $data = $this->cislembaga->find($id);
        $kegiatan = [];
        foreach ($data->konsultan as $row) {
            foreach ($row->kegiatan as $kg) {
                $kegiatan[] = $kg;
            }
        }

        return $kegiatan;
    }
}
