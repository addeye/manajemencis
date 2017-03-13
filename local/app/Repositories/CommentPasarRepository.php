<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 13/03/2017
 * Time: 12:51
 */

namespace App\Repositories;


use App\CommentPasar;

class CommentPasarRepository
{
    protected $comment_pasar;

    public function __construct(CommentPasar $commentPasar)
    {
        $this->comment_pasar = $commentPasar;
    }

    // Select All
    Public function getAll()
    {
        return $this->comment_pasar->orderBy('id','desc')->get();
    }

    // Select where id
    public function getById($id)
    {
        return $this->comment_pasar->find($id);
    }

    // Insert into
    public function create($data=array())
    {
        $result = $this->comment_pasar->create($data);
        if ($result)
        {
            return true;
        }

        return false;
    }


    // Update
    public function update($id,$data=array())
    {
        $result =$this->comment_pasar->find($id)->update($data);
        if ($result)
        {
            return true;
        }

        return false;
    }

    // Delete
    public function delete($id)
    {
        $result = $this->comment_pasar->destroy($id);
        if ($result)
        {
            return true;
        }
        return false;
    }
}