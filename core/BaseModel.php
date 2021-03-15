<?php 

class BaseModel
{
    public $conn;
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=ta_perpus", 'root', '');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Koneksi gagal: ' . $e->getMessage();
        }
    }

    public function query($sql)
    {
        $exec = $this->conn->prepare($sql);
        $exec->execute();
        $exec->setFetchMode(PDO::FETCH_ASSOC);
        return $exec->fetchAll();
    }
}