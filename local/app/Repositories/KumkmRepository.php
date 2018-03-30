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
            return $this->kumkm->with('lembaga','provinces','regencies','districts','villages','sentra_kumkm','bidangusaha')->where('lembaga_id',$lembaga_id)->paginate(10);
        }
        elseif(Auth::user()->role_id==3)
        {
            $lembaga_id = Auth::user()->konsultans->lembaga_id;
            return $this->kumkm->with('lembaga','provinces','regencies','districts','villages','sentra_kumkm','bidangusaha')->where('lembaga_id',$lembaga_id)->paginate(10);
        }
        elseif(Auth::user()->role_id==1)
        {
            return $this->kumkm->with('lembaga','provinces','regencies','districts','villages','sentra_kumkm','bidangusaha')->paginate(10);
        }
    }

    public function getBySearch($search)
    {

        if(Auth::user()->role_id==2)
        {
            $lembaga_id = Auth::user()->adminlembagas->lembaga_id;
            return $this->kumkm->with('lembaga','provinces','regencies','districts','villages','sentra_kumkm','bidangusaha')->where('lembaga_id',$lembaga_id)->where('nama_usaha','LIKE',"%$search%")->paginate(10);
        }
        elseif(Auth::user()->role_id==3)
        {
            $lembaga_id = Auth::user()->konsultans->lembaga_id;
            return $this->kumkm->with('lembaga','provinces','regencies','districts','villages','sentra_kumkm','bidangusaha')->where('lembaga_id',$lembaga_id)->where('nama_usaha','LIKE',"%$search%")->paginate(10);
        }
        elseif(Auth::user()->role_id==1)
        {
            return $this->kumkm->with('lembaga','provinces','regencies','districts','villages','sentra_kumkm','bidangusaha')->where('nama_usaha','LIKE',"%$search%")->paginate(10);
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
            return $result;
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