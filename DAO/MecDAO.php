<?php

require_once '../config/DB.php';
require_once '../model/Mec.php';

class MecDAO 
{
    private $db;
    public function __construct()
    {
        $this->db = DB::createInstance();
    }

    public function getAllMecevi()
    {
        $statement = $this->db->prepare('SELECT * FROM mecevi');
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function InsertMec($mec)
    {

        $statement = $this->db->prepare("INSERT INTO mecevi(tip_meca) VALUES(?)");
        $statement->bindValue(1, $mec->getTip_meca());
        return $statement->execute() == true ? true : false;
    }

    public function UpdateMec($id, $mec)
    {

        $statement = $this->db->prepare("UPDATE  mecevi SET tip_meca=? WHERE id=?");

        $statement->bindValue(1, $mec->getTip_meca());
        $statement->bindValue(2, $id);
        return  $statement->execute();
    }

    public function DeleteMec($id)
    {
        $statement = $this->db->prepare("DELETE FROM  mecevi  WHERE id=?");

        $statement->bindValue(1,$id);
        return $statement->execute();
    }

    public function getMeceviById($id)
    {
        $statement = $this->db->prepare('SELECT * FROM mecevi WHERE id=?');
        $statement->bindValue(1, $id);
        $statement->execute();
        $res = $statement->fetch();
        if ($res != null) {
            return $res;
        }
        return null;
    }

}