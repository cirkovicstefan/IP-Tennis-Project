<?php
require_once '../DAO/SportskiKlubDAO.php';
require_once '../model/SportiskiKlub.php';

class ControllerKlubovi
{

    public function InsertKlubovi()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $naziv = isset($_POST['naziv']) ? $this->test_input($_POST['naziv']) : '';
            $adresa = isset($_POST['adresa']) ? $this->test_input($_POST['adresa']) : '';
            
            $sportski_klub = new SportiskiKlub();
            $sportski_klub->setNaziv($naziv);
            $sportski_klub->setAdresa($adresa);
            
            session_start();
            $_SESSION['klub'] = serialize($sportski_klub);
            if (!empty($naziv) && !empty($adresa)) {
                if (is_string($adresa)) {
                    $sportski_klubDAO = new SportskiKlubDAO();
                    $sportski_klub = new SportiskiKlub();
                    $sportski_klub->setNaziv($naziv);
                    $sportski_klub->setAdresa($adresa);
                    $sportski_klubDAO ->InsertSportskiK($sportski_klub);
                    header("Location:../view-admin/klubovi.php");
                } else {
                    $msg = 'Adresa mora da bude string tipa';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-admin/formaInsertKlubovi.php");
                }
            } else {
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-admin/formaInsertKlubovi.php");
            }
        }
    }

    public function EditKlub($id)
    {
        $sportski_kluboviDAO = new SportskiKlubDAO();
        $sportski_klubovi = $sportski_kluboviDAO->getKluboviById($id);
        session_start();
        $_SESSION['klub1'] = ($sportski_klubovi);
        header("Location:../view-admin/formaUpdateKlubovi.php");
    }

    public function UpdateKlub()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $naziv = isset($_POST['naziv']) ? $this->test_input($_POST['naziv']) : '';
            $adresa = isset($_POST['adresa']) ? $this->test_input($_POST['adresa']) : '';
            $id =  isset($_POST['id']) ? $this->test_input($_POST['id']) : "";
            
            
            session_start();
            $_SESSION['klub1'] = array();
            $_SESSION['klub1']['id'] = $id;
            $_SESSION['klub1']['naziv'] = $naziv;
            $_SESSION['klub1']['adresa'] = $adresa;

            if (!empty($naziv) && !empty($adresa)) {
                if (is_string($adresa)) {
                    $sportski_klubDAO = new SportskiKlubDAO();
                    $sportski_klubovi = new SportiskiKlub();
                    $sportski_klubovi->setNaziv($naziv);
                    $sportski_klubovi->setAdresa($adresa);
                    $sportski_klubDAO ->UpdateSportskiKlubovi($id, $sportski_klubovi);
                    header("Location:../view-admin/klubovi.php");
                } else {
                    $msg = 'Adresa mora da bude string tipa';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-admin/formaUpdateKlubovi.php");
                }
            } else {
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-admin/formaUpdateKlubovi.php");
            }
        }
    }
    public function DeleteKlubovi($id)
    {
        $sportski_klubDAO = new SportskiKlubDAO();
        $res = $sportski_klubDAO->DeleteSportskiKlubovi($id);
        $msg = $res;
        session_start();
        $_SESSION['msg'] = $msg;
        header("Location:../view-admin/klubovi.php");
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
