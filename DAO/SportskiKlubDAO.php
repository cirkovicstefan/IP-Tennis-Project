<?php
require_once '../model/SportiskiKlub.php';
require_once '../config/DB.php';

class SportskiKlubDAO
{
    private $db;
    public function __construct()
    {
        $this->db = DB::createInstance();
    }
    public function InsertSportskiK($sportski_klub)
    {
        $statement = $this->db->prepare('INSERT INTO sportski_klubovi(naziv,adresa) VALUES(?,?)');
        $statement->bindValue(1, $sportski_klub->getNaziv());
        $statement->bindValue(2, $sportski_klub->getAdresa());
        return $statement->execute() == true ? true : false;
    }
    public function getAllSportskiKlubovi()
    {
        $statement = $this->db->prepare('SELECT * FROM sportski_klubovi');
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }
    public function UpdateSportskiKlubovi($id, $sportski_klubovi)
    {
        $statement = $this->db->prepare("UPDATE  sportski_klubovi SET naziv=?, adresa=? WHERE id=?");

        $statement->bindValue(1, $sportski_klubovi->getNaziv());
        $statement->bindValue(2, $sportski_klubovi->getAdresa());
        $statement->bindValue(3, $id);
        return  $statement->execute();
    }
    public function DeleteSportskiKlubovi($id)
    {
        $statement = $this->db->prepare("DELETE FROM  sportski_klubovi  WHERE id=?");

        $statement->bindValue(1, $id);
        return $statement->execute();
    }

    public function getKluboviById($id)
    {
        $statement = $this->db->prepare('SELECT * FROM sportski_klubovi WHERE id=?');
        $statement->bindValue(1, $id);
        $statement->execute();
        $res = $statement->fetch();
        if ($res != null) {
            return $res;
        }
        return null;
    }
}
