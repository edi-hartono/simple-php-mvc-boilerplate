<?php 

require_once('core/BaseModel.php');

class Book extends BaseModel
{
    public function getAllBoook()
    {
        return $this->query("SELECT * FROM buku");
    }
}