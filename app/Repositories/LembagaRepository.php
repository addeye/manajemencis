<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 01/02/2017
 * Time: 15:34
 */

namespace App\Repositories;


use App\Admin_lembaga;
use App\Lembaga;
use Illuminate\Support\Facades\Auth;

class LembagaRepository
{
    protected $table;
    protected $adminlembaga;

    public function __construct(Lembaga $lembaga, Admin_lembaga $adminlembaga)
    {
        $this->table = $lembaga;
        $this->adminlembaga = $adminlembaga;
    }

    public function getAll()
    {
        return Lembaga::all();
    }

    public function getById($id)
    {
        return Lembaga::find($id);
    }



    public function create($data=array())
    {
        $result = Lembaga::create($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function update($id,$data)
    {
        $result = Lembaga::find($id)->update($data);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $result = Lembaga::destroy($id);
        if($result)
        {
            return true;
        }
        return false;
    }

    public function transformator($data)
    {
        $rowData = array();
        if(isset($data['idlembaga']) and $data['idlembaga']!='')
        {
            $rowData['idlembaga'] = $data['idlembaga'];
        }
        return $rowData;
    }

    /*For Admin Lembaga*/

    public function getLembagaForAdmin()
    {
        $user_id = Auth::user()->id;
        $admin = $this->adminlembaga->where('user_id',$user_id)->first();
        $lembaga_id = $admin->lembaga_id;
        return $this->table->find($lembaga_id);

    }
}