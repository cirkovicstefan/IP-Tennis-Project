<?php

require_once '../config/DB.php';
require_once '../model/PregledRezultata.php';


class PregledRezultataDAO
{
    private $db;
    public function __construct()
    {
        $this->db = DB::createInstance();
    }

    public function getAllPregledRezultata()
    {
        $statement = $this->db->prepare('SELECT * FROM pregled_rezultata');
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function InsertPregledRezultata($pregledRezultata)
    {
        $ind = false;
        foreach ($this->getAllPregledRezultata() as $item) {
            if ($item['id_rezervacije'] == $pregledRezultata->getId_rezervacije()) {
                $ind = true;
                break;
            }
        }
        if ($ind == false) {
            $statement = $this->db->prepare("INSERT INTO pregled_rezultata(rezultat, potvrda_rezultata, id_rezervacije, status_meca) VALUES(?,?,?,?)");
            $statement->bindValue(1, $pregledRezultata->getRezultat());
            $statement->bindValue(2, $pregledRezultata->getPotvrda_rezultata());
            $statement->bindValue(3, $pregledRezultata->getId_rezervacije());
            $statement->bindValue(4, $pregledRezultata->getStatus_meca());
            return $statement->execute() == true ? "Uspešno ste uneli rezultat" : "Greška";
        } else {
            return 'Već ste uneli rezultate za ovu rezervaciju';
        }
    }

    public function UpdatePregledRezultata($id, $pregledRezultata)
    {

        $statement = $this->db->prepare("UPDATE pregled_rezultata SET rezultat=?,potvrda_rezultata=?, id_rezervacije=?, status_meca=? WHERE id=?");

        $statement->bindValue(1, $pregledRezultata->getRezultat());
        $statement->bindValue(2, $pregledRezultata->getPotvrda_rezultata());
        $statement->bindValue(3, $pregledRezultata->getId_rezervacije());
        $statement->bindValue(4, $pregledRezultata->getStatus_meca());

        $statement->bindValue(5, $id);
        return  $statement->execute();
    }

    public function DeletePregledRezultata($id)
    {
        $statement = $this->db->prepare("DELETE FROM  pregled_rezultata  WHERE id=?");

        $statement->bindValue(1, $id);
        return $statement->execute() ? 'Uspešno ste poništili rezultat' : 'Greška';
    }
    public function getAllJOIN()
    {
        $sql = "SELECT rez.*, pre.* FROM rezervacije rez join pregled_rezultata pre on rez.id = pre.id_rezervacije;";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function sortAllJOIN()
    {
        $sql = "SELECT rez.*, pre.* FROM rezervacije rez join pregled_rezultata pre on rez.id = pre.id_rezervacije;";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function getPregledById($id)
    {
        $statement = $this->db->prepare('SELECT * FROM pregled_rezultata WHERE id=?');
        $statement->bindValue(1, $id);
        $statement->execute();
        $res = $statement->fetch();
        if ($res != null) {
            return $res;
        }
        return null;
    }

 
}
