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
use Illuminate\Support\Facades\Auth;

class CisLembagaRepository
{
    protected $cislembaga;
    protected $adminlembaga;

    public function __construct(Cis_lembaga $cis_lembaga, Admin_lembaga $admin_lembaga)
    {
        $this->cislembaga = $cis_lembaga;
        $this->adminlembaga = $admin_lembaga;
    }

    public function getAll()
    {
        return $this->cislembaga->orderBy('id_lembaga','ASC')->get();
    }

    public function getById($id)
    {
        return $this->cislembaga->find($id);
    }

    public function create($data=array())
    {
        $result = $this->cislembaga->create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    public function update($id,$data=array())
    {
        $result = $this->cislembaga->find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->cislembaga->destroy($id);
        if ($result)
        {
            return true;
        }

        return false;

    }

    public function getLembagaForAdmin()
    {
        $user_id = Auth::user()->id;
        $admin = $this->adminlembaga->where('user_id',$user_id)->first();
        $lembaga_id = $admin->lembaga_id;
        return $this->cislembaga->find($lembaga_id);

    }

    public function getLembagaForKonsultan()
    {
        $lembaga_id = Auth::user()->konsultans->lembaga_id;
        return $this->cislembaga->find($lembaga_id);
    }
}