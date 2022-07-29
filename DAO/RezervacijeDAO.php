<?php
require_once '../config/DB.php';
require_once '../model/Rezervacija.php';
require_once '../DAO/TerenDAO.php';
require_once '../DAO/PregledRezultataDAO.php';

class RezervacijeDAO
{

    private $db;
    public function __construct()
    {
        $this->db = DB::createInstance();
    }

    public function InsertRezervacije($rezervacije)
    {
        $terniDAO = new TerenDAO();
        $tereni = $terniDAO->getAllTereni();
        $msg = '';
        foreach ($tereni as $item) {
            //print_r($item['id']);
            if ($item['id'] == $rezervacije->getId_terena() && $item['zauzet'] == 0) {
                if ($rezervacije->getId_igraca1() != $rezervacije->getId_igraca2()) {
                    if ($rezervacije->getId_igraca3() != NULL && $rezervacije->getId_igraca4() != NULL) {
                        if (
                            $rezervacije->getId_igraca1() != $rezervacije->getId_igraca3()
                            && $rezervacije->getId_igraca2() != $rezervacije->getId_igraca3()
                            && $rezervacije->getId_igraca1() != $rezervacije->getId_igraca4()
                            && $rezervacije->getId_igraca2() != $rezervacije->getId_igraca4()
                            && $rezervacije->getId_igraca3() != $rezervacije->getId_igraca4()
                        ) {
                            $statement = $this->db->prepare('INSERT INTO rezervacije(id_igraca1 ,id_igraca2,id_igraca3 ,id_igraca4,id_terena, id_meca,datum,vreme) VALUES(?,?,?,?,?,?,?,?)');
                            $statement->bindValue(1, $rezervacije->getId_igraca1());
                            $statement->bindValue(2, $rezervacije->getId_igraca2());
                            $statement->bindValue(3, $rezervacije->getId_igraca3());
                            $statement->bindValue(4, $rezervacije->getId_igraca4());
                            $statement->bindValue(5, $rezervacije->getId_terena());
                            $statement->bindValue(6, $rezervacije->getId_meca());
                            $statement->bindValue(7, $rezervacije->getDatum());
                            $statement->bindValue(8, $rezervacije->getVreme());
                            if ($statement->execute() == true) {
                                $terniDAO->SetZauzetostTerena($rezervacije->getId_terena(), 1);
                                return "Uspešno ste rezervisali";
                            }
                            return "Greška";
                        } else {
                            return "Igrači nemogu igrati sami protiv sebe";
                        }
                    } else {
                        $statement = $this->db->prepare('INSERT INTO rezervacije(id_igraca1 ,id_igraca2,id_igraca3 ,id_igraca4,id_terena, id_meca,datum,vreme) VALUES(?,?,?,?,?,?,?,?)');
                        $statement->bindValue(1, $rezervacije->getId_igraca1());
                        $statement->bindValue(2, $rezervacije->getId_igraca2());
                        $statement->bindValue(3, NULL);
                        $statement->bindValue(4, NULL);
                        $statement->bindValue(5, $rezervacije->getId_terena());
                        $statement->bindValue(6, $rezervacije->getId_meca());
                        $statement->bindValue(7, $rezervacije->getDatum());
                        $statement->bindValue(8, $rezervacije->getVreme());
                        if ($statement->execute() == true) {
                            $terniDAO->SetZauzetostTerena($rezervacije->getId_terena(), true);
                            return "Uspešno ste rezervisali";
                        }
                        return "Greška";
                    }
                }
                return "Igrači ne mogu igrati sami protiv sebe";
            } else {
                $msg = 'Teren je zauzet';
            }
        }
        return $msg;
    }

    public function getAllRezervacije()
    {
        $sql = "SELECT r.id as 'id_r',r.*,t.*,m.* FROM rezervacije r join  tereni t ON r.id_terena=t.id JOIN mecevi m ON m.id = r.id_meca;";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function DeleteRezervacije($id, $id_terena)
    {
        $pregledRezDAO = new PregledRezultataDAO();
        $yes = false;
        foreach ($pregledRezDAO->getAllPregledRezultata() as $item) {
            if ($item['id_rezervacije'] == $id) {
                $yes = true;
                break;
            }
        }
        if ($yes == false) {
            $ind1 = false;
            $ind2 = false;
            $statement = $this->db->prepare("DELETE FROM  rezervacije  WHERE id=?");
            $statement->bindValue(1, $id);
            $ind1 = $statement->execute() == true ? true : false;
            $tereniDAO = new TerenDAO();
            $ind2 = $tereniDAO->SetZauzetostTerena($id_terena, false);
            if ($ind1 == true && $ind2 == true) {
                return 'Uspešno ste poništili rezervaciju';
            } else {
                return 'Greška';
            }
        } else {
            return 'Rezervacija je povezana sa pregledom rezultata';
        }
    }
    public function UpdateRezervacije($id, $rezervacije)
    {
        $statement = $this->db->prepare("UPDATE  rezervacije SET id_igraca1=?,id_igraca2=?,id_igraca3=?,id_igraca4=?,id_terena=?,id_meca=?,datum=?,vreme=? WHERE id=?");

        $statement->bindValue(1, $rezervacije->getId_igraca1());
        $statement->bindValue(2, $rezervacije->getId_igraca2());
        $statement->bindValue(3, $rezervacije->getId_igraca3());
        $statement->bindValue(4, $rezervacije->getId_igraca4());
        $statement->bindValue(5, $rezervacije->getId_terena());
        $statement->bindValue(6, $rezervacije->getId_meca());
        $statement->bindValue(7, $rezervacije->getDatum());
        $statement->bindValue(8, $rezervacije->getVreme());
        $statement->bindValue(9, $id);
        return  $statement->execute();
    }

    public function getRezervacijeById($id)
    {
        $sql = "SELECT * FROM rezervacije WHERE id=?";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
        $res = $statement->fetch();
        if ($res != null) {
            return $res;
        }
        return null;
    }
}
