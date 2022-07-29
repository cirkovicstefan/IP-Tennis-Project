<?php
require_once '../config/DB.php';
require_once '../model/TipOpreme.php';
class TipOpremeDAO
{
    private $db;
    public function __construct()
    {
        $this->db = DB::createInstance();
    }
    public function InsertTipOpreme($tip_opreme)
    {
        $statement = $this->db->prepare('INSERT INTO tip_opreme(tipovi_opreme) VALUES(?)');
        $statement->bindValue(1, $tip_opreme->getTipovi_opreme());
        return $statement->execute() == true ? true : false;
    }
    public function UpdateTipOpreme($id, $tip_opreme)
    {
        $statement = $this->db->prepare("UPDATE  tip_opreme SET tipovi_opreme=? WHERE id=?");

        $statement->bindValue(1, $tip_opreme->getTipovi_opreme());
        $statement->bindValue(2, $id);
        return  $statement->execute();
    }

    public function getAllTipoviOpreme()
    {
        $statement = $this->db->prepare('SELECT * FROM tip_opreme');
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }
    public function DeleteTipoviOpreme($id)
    {
        $statement = $this->db->prepare("DELETE FROM  tip_opreme  WHERE id=?");

        $statement->bindValue(1, $id);
        return $statement->execute();
    }
}
