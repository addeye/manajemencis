<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 08/02/2017
 * Time: 11:15
 */

namespace App\Repositories;


use App\Admin_lembaga;
use App\Sentra_kumkm;
use Illuminate\Support\Facades\Auth;

class SentraKumkmRepository
{
    protected $sentra;
    protected $adminlembaga;

    public function __construct(Sentra_kumkm $sentra, Admin_lembaga $adminlembaga)
    {
        $this->sentra = $sentra;
        $this->adminlembaga = $adminlembaga;
    }

    Public function getAll()
    {
        return Sentra_kumkm::all();
    }

    // Select where id
    public function getById($id)
    {
        return Sentra_kumkm::find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = Sentra_kumkm::create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =Sentra_kumkm::find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $data = Sentra_kumkm::find($id);
        $user_id = $data->user_id;
        $result = Sentra_kumkm::destroy($id);
        if ($result)
        {
            User::destroy($user_id);
            return true;
        }
        return false;
    }

    /*For Admin Get Sentra*/
    public function getSentraByAdmin()
    {
        $lembaga_id = Auth::user()->adminlembagas->lembaga_id;
        return $this->sentra->where('id_lembaga',$lembaga_id)->get();
    }
}