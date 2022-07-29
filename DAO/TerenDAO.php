<?php
require_once '../config/DB.php';
require_once '../model/Teren.php';
require_once '../DAO/RezervacijeDAO.php';

class TerenDAO
{
    private $db;
    public function __construct()
    {
        $this->db = DB::createInstance();
    }

    public function getAllTereni()
    {
        $statement = $this->db->prepare('SELECT * FROM tereni');
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function InsertTeren($teren)
    {

        $statement = $this->db->prepare("INSERT INTO tereni(naziv,lokacija,vrsta_podloge,kapacitet,id_kluba,zauzet) VALUES(?,?,?,?,?,?)");
        $statement->bindValue(1, $teren->getNaziv());
        $statement->bindValue(2, $teren->getLokacija());
        $statement->bindValue(3, $teren->getVrstaPodloge());
        $statement->bindValue(4, $teren->getKapacitet());
        $statement->bindValue(5, $teren->getIdKluba());
        $statement->bindValue(6, $teren->getZauzet());
        return $statement->execute() == true ? true : false;
    }

    public function UpdateTeren($id, $teren)
    {

        $statement = $this->db->prepare("UPDATE  tereni SET naziv=?,lokacija=?,vrsta_podloge=?,kapacitet=?,id_kluba=?,zauzet=? WHERE id=?");

        $statement->bindValue(1, $teren->getNaziv());
        $statement->bindValue(2, $teren->getLokacija());
        $statement->bindValue(3, $teren->getVrstaPodloge());
        $statement->bindValue(4, $teren->getKapacitet());
        $statement->bindValue(5, $teren->getIdKluba());
        $statement->bindValue(6, $teren->getZauzet());
        $statement->bindValue(7, $id);
        return  $statement->execute();
    }

    public function DeleteTeren($id)
    {
        $rezervacijaDAO = new RezervacijeDAO();
        $rezervacije = $rezervacijaDAO->getAllRezervacije();
        $ind = false;
        foreach ($rezervacije as $item) {
            if ($item['id_terena'] == $id) {
                $ind = true;
                break;
            }
        }
        if ($ind == true) {
            return 'Podatak je povezan sa rezervacijom';
        } else {
            $statement = $this->db->prepare("DELETE FROM  tereni  WHERE id=?");

            $statement->bindValue(1, $id);
            return $statement->execute() == true ? "Uspešno ste obrisali teren" : '';
        }
    }

    public function getAllTereniKluboviJOIN()
    {
        $sql = "SELECT t.*,s.naziv as 'naziv-kluba',s.adresa FROM sportski_klubovi s INNER JOIN tereni t ON t.id_kluba = s.id;";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }
    public function SetZauzetostTerena($id, $status)
    {
        $statement = $this->db->prepare("UPDATE  tereni SET zauzet=? WHERE id=?");
        $statement->bindValue(1, $status);
        $statement->bindValue(2, $id);
        return  $statement->execute();
    }
    public function getTereniById($id)
    {
        $statement = $this->db->prepare('SELECT * FROM tereni WHERE id=?');
        $statement->bindValue(1, $id);
        $statement->execute();
        $res = $statement->fetch();
        if ($res != null) {
            return $res;
        }
        return null;
    }
}
