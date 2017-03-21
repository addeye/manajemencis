<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 18/03/2017
 * Time: 13:56
 */

namespace App\Repositories;


use App\Kumkm;
use Illuminate\Support\Facades\Auth;

class KumkmRepository
{
    protected $kumkm;

    public function __construct(Kumkm $kumkm)
    {
        $this->kumkm = $kumkm;
    }
    // Select All
    Public function getAll()
    {
        if(Auth::user()->role_id==2)
        {
            $lembaga_id = Auth::user()->adminlembagas->lembaga_id;
            return $this->kumkm->where('lembaga_id',$lembaga_id)->get();
        }
        elseif(Auth::user()->role_id==3)
        {
            $lembaga_id = Auth::user()->konsultans->lembaga_id;
            return $this->kumkm->where('lembaga_id',$lembaga_id)->get();
        }
        elseif(Auth::user()->role_id==1)
        {
            return $this->kumkm->all();
        }
    }

    // Select where id
    public function getById($id)
    {
        return $this->kumkm->find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = $this->kumkm->create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =$this->kumkm->find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = $this->kumkm->destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }
}