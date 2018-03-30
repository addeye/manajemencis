<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 24/03/2017
 * Time: 13:37
 */

namespace App\Repositories;
use Auth;


use App\ProdukUnggulan;

class ProdukUnggulanRepository
{
    protected $produk;

    public function __construct(ProdukUnggulan $produkUnggulan)
    {
        $this->produk = $produkUnggulan;
    }

    //Select All
    Public function getAll()
    {
        $user = Auth::user();
        if($user->role_id == 1)
        {
            return $this->produk->all();
        }
        elseif ($user->role_id == 2) {
            $lembaga_id = $user->adminlembagas->lembaga_id;
            return $this->produk->where('lembaga_id','=',$lembaga_id)->get();
        }
        elseif ($user->role_id == 3) {
            $lembaga_id = $user->konsultans->lembaga_id;
            return $this->produk->where('lembaga_id','=',$lembaga_id)->get();
        }
    }

    // Select where id
    public function getById($id)
    {
        return $this->produk->find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = $this->produk->create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =$this->produk->find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = $this->produk->destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }
}