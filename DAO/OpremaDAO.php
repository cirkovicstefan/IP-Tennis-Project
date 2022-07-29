<?php
require_once '../config/DB.php';
require_once '../model/Oprema.php';

class OpremaDAO
{
    private $db;
    public function __construct()
    {
        $this->db = DB::createInstance();
    }
    public function InsertOprema($opreme)
    {
        $statement = $this->db->prepare("INSERT INTO opreme(opis,naziv,id_tip_opreme) VALUES(?,?,?)");
        $statement->bindValue(1, $opreme->getOpis());
        $statement->bindValue(2, $opreme->getNaziv());
        $statement->bindValue(3, $opreme->getId_tip_opreme());

        return $statement->execute() == true ? true : false;
    }

    public function UpdateOprema($id, $opreme)
    {
        $statement = $this->db->prepare("UPDATE  opreme SET opis=?,naziv=?,id_tip_opreme=? WHERE id=?");
        $statement->bindValue(1, $opreme->getOpis());
        $statement->bindValue(2, $opreme->getNaziv());
        $statement->bindValue(3, $opreme->getId_tip_opreme());
        $statement->bindValue(4, $id);
        return  $statement->execute();
    }

    public function getAllOprema()
    {
        $statement = $this->db->prepare('SELECT * FROM opreme');
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }
    public function getAllOpremeTipOpremeJOIN()
    {
        $sql = "select o.*,t.* FROM opreme o INNER JOIN tip_opreme t ON o.id_tip_opreme = t.id;";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function DeleteOprema($id)
    {
        $statement = $this->db->prepare("DELETE FROM  opreme  WHERE id=?");

        $statement->bindValue(1, $id);
        return $statement->execute();
    }
}
