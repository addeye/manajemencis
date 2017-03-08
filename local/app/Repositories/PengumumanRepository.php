<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 08/03/2017
 * Time: 14:23
 */

namespace App\Repositories;


use App\Pengumuman;
use Illuminate\Support\Facades\Auth;

class PengumumanRepository
{
    protected $pengumuman;

    public function __construct(Pengumuman $pengumuman)
    {
        $this->pengumuman = $pengumuman;
    }

    // Select All
    Public function getAll()
    {
        return $this->pengumuman->all();
    }

    // Select where id
    public function getById($id)
    {
        return $this->pengumuman->find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $data['user_id'] = Auth::user()->id;
        $result = $this->pengumuman->create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =$this->pengumuman->find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = $this->pengumuman->destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }
}