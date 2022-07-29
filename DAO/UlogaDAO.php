<?php

require_once '../config/DB.php';
require_once '../model/Uloge.php';

class UlogaDAO
{
    private $db;
    public function __construct()
    {
        $this->db = DB::createInstance();
    }

    public function getAllUloge()
    {
        $statement = $this->db->prepare('SELECT * FROM uloge');
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

}