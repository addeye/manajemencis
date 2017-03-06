<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 06/03/2017
 * Time: 14:06
 */

namespace App\Repositories;


use App\Banner;

class BannerRepository
{
    protected $banner;

    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    // Select All
    Public function getAll()
    {
        return $this->banner->all();
    }

    // Select where id
    public function getById($id)
    {
        return $this->banner->find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = $this->banner->create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =$this->banner->find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = $this->banner->destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }
}