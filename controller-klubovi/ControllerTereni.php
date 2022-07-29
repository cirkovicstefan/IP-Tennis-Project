<?php
require_once '../DAO/TerenDAO.php';
require_once '../model/Teren.php';

class ControllerTereni
{

    public function InsertTereni()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $naziv = isset($_POST['naziv']) ? $this->test_input($_POST['naziv']) : '';
            $lokacija = isset($_POST['lokacija']) ? $this->test_input($_POST['lokacija']) : '';
            $vrsta_podloge = isset($_POST['vrsta_podloge']) ? $this->test_input($_POST['vrsta_podloge']) : '';
            $kapcitet = isset($_POST['kapacitet']) ? $this->test_input($_POST['kapacitet']) : '';
            $zauzet = isset($_POST['zauzet']) ? $this->test_input($_POST['zauzet']) : '';
            $id_kluba = isset($_POST['id_kluba']) ? $this->test_input($_POST['id_kluba']) : "";
            if ($zauzet == 'on') {
                $zauzet = true;
            } else {
                $zauzet = false;
            }
            $teren = new Teren();
            $teren->setNaziv($naziv);
            $teren->setLokacija($lokacija);
            $teren->setVrstaPodloge($vrsta_podloge);
            $teren->setKapacitet($kapcitet);
            $teren->setZauzet($zauzet);
            $teren->setIdKluba($id_kluba);
            session_start();
            $_SESSION['teren'] = serialize($teren);
            if (!empty($naziv) && !empty($lokacija) && !empty($vrsta_podloge) && !empty($kapcitet)  && !empty($id_kluba)) {
                if (is_numeric($kapcitet)) {
                    $tereniDAO = new TerenDAO();
                    $teren = new Teren();
                    $teren->setNaziv($naziv);
                    $teren->setLokacija($lokacija);
                    $teren->setVrstaPodloge($vrsta_podloge);
                    $teren->setKapacitet($kapcitet);
                    $teren->setZauzet($zauzet);
                    $teren->setIdKluba($id_kluba);
                    $tereniDAO->InsertTeren($teren);
                    header("Location:../view-klubovi/tereni.php");
                } else {
                    $msg = 'Kapacitet mora da bude numeričkog tipa';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-klubovi/formaInserttereni.php");
                }
            } else {
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-klubovi/formaInserttereni.php");
            }
        }
    }

    public function EditTeren($id)
    {
        $tereniDAO = new TerenDAO();
        $teren = $tereniDAO->getTereniById($id);
        session_start();
        $_SESSION['teren1'] = ($teren);
        header("Location:../view-klubovi/formaUpdateTeren.php");
    }

    public function UpdateTeren()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $naziv = isset($_POST['naziv']) ? $this->test_input($_POST['naziv']) : '';
            $lokacija = isset($_POST['lokacija']) ? $this->test_input($_POST['lokacija']) : '';
            $vrsta_podloge = isset($_POST['vrsta_podloge']) ? $this->test_input($_POST['vrsta_podloge']) : '';
            $kapcitet = isset($_POST['kapacitet']) ? $this->test_input($_POST['kapacitet']) : '';
            $zauzet = isset($_POST['zauzet']) ? $this->test_input($_POST['zauzet']) : '';
            $id_kluba = isset($_POST['id_kluba']) ? $this->test_input($_POST['id_kluba']) : "";
            $id =  isset($_POST['id']) ? $this->test_input($_POST['id']) : "";
            if ($zauzet == 'on') {
                $zauzet = true;
            } else {
                $zauzet = false;
            }
            
            session_start();
            $_SESSION['teren1'] = array();
            $_SESSION['teren1']['id'] = $id;
            $_SESSION['teren1']['naziv'] = $naziv;
            $_SESSION['teren1']['lokacija'] = $lokacija;
            $_SESSION['teren1']['vrsta_podloge'] = $vrsta_podloge;
            $_SESSION['teren1']['kapacitet'] = $kapcitet;
            $_SESSION['teren1']['zauzet'] = $zauzet;
            $_SESSION['teren1']['id_kluba'] = $id_kluba;
            $_SESSION['teren1']['id'] = $id;



            if (!empty($naziv) && !empty($lokacija) && !empty($vrsta_podloge) && !empty($kapcitet)  && !empty($id_kluba)) {
                if (is_numeric($kapcitet)) {
                    $tereniDAO = new TerenDAO();
                    $teren = new Teren();
                    $teren->setNaziv($naziv);
                    $teren->setLokacija($lokacija);
                    $teren->setVrstaPodloge($vrsta_podloge);
                    $teren->setKapacitet($kapcitet);
                    $teren->setZauzet($zauzet);
                    $teren->setIdKluba($id_kluba);
                    $tereniDAO->UpdateTeren($id, $teren);
                    header("Location:../view-klubovi/tereni.php");
                } else {
                    $msg = 'Kapacitet mora da bude numeričkog tipa';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-klubovi/formaUpdateTeren.php");
                }
            } else {
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-klubovi/formaUpdateTeren.php");
            }
        }
    }
    public function DeleteTereni($id)
    {
        $tereniDAO = new TerenDAO();
        $res = $tereniDAO->DeleteTeren($id);
        $msg = $res;
        session_start();
        $_SESSION['msg'] = $msg;
        header("Location:../view-klubovi/tereni.php");
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
