<?php
require_once '../DAO/RezervacijeDAO.php';
require_once '../model/Rezervacija.php';

class RezervacijaController
{


    public function InsertRezervacijeDouble()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id_igraca1 = isset($_POST['id_igraca1']) ? $this->test_input($_POST['id_igraca1']) : '';
            $id_igraca2 = isset($_POST['id_igraca2']) ? $this->test_input($_POST['id_igraca2']) : '';
            $id_igraca3 = isset($_POST['id_igraca3']) ? $this->test_input($_POST['id_igraca3']) : '';
            $id_igraca4 = isset($_POST['id_igraca4']) ? $this->test_input($_POST['id_igraca4']) : '';
            $id_terena = isset($_POST['id_terena']) ? $this->test_input($_POST['id_terena']) : '';
            $id_meca = isset($_POST['id_meca']) ? $this->test_input($_POST['id_meca']) : '';
            $datum = isset($_POST['datum']) ? $this->test_input($_POST['datum']) : '';
            $vreme = isset($_POST['vreme']) ? $this->test_input($_POST['vreme']) : '';

            if (!empty($id_igraca1) && !empty($id_igraca2) && !empty($id_igraca3) && !empty($id_igraca4) && !empty($id_terena) && !empty($id_meca) && !empty($datum) && !empty($vreme)) {

                $rezervacija = new Rezervacija();
                $rezervacija->setId_igraca1($id_igraca1);
                $rezervacija->setId_igraca2($id_igraca2);
                $rezervacija->setId_igraca3($id_igraca3);
                $rezervacija->setId_igraca4($id_igraca4);
                $rezervacija->setId_terena($id_terena);
                $rezervacija->setId_meca($id_meca);
                $rezervacija->setDatum($datum);
                $rezervacija->setVreme($vreme);
                //print_r($rezervacija);
                $rezervacijeDAO = new RezervacijeDAO();
                $poruka = $rezervacijeDAO->InsertRezervacije($rezervacija);
                session_start();
                $_SESSION['msg'] = $poruka;
                if ($poruka == 'Uspešno ste rezervisali') {
                    header("Location:../view-klubovi/rezervacije.php");
                } else {
                    header("Location:../view-klubovi/formaInsertRezervacijaDouble.php");
                }
            } else {
                session_start();
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-klubovi/formaInsertRezervacijaDouble.php");
            }
        }
    }
    public function InsertRezervacijeSingle()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id_igraca1 = isset($_POST['id_igraca1']) ? $this->test_input($_POST['id_igraca1']) : '';
            $id_igraca2 = isset($_POST['id_igraca2']) ? $this->test_input($_POST['id_igraca2']) : '';

            $id_terena = isset($_POST['id_terena']) ? $this->test_input($_POST['id_terena']) : '';
            $id_meca = isset($_POST['id_meca']) ? $this->test_input($_POST['id_meca']) : '';
            $datum = isset($_POST['datum']) ? $this->test_input($_POST['datum']) : '';
            $vreme = isset($_POST['vreme']) ? $this->test_input($_POST['vreme']) : '';

            if (!empty($id_igraca1) && !empty($id_igraca2)  && !empty($id_terena) && !empty($id_meca) && !empty($datum) && !empty($vreme)) {

                $rezervacija = new Rezervacija();
                $rezervacija->setId_igraca1($id_igraca1);
                $rezervacija->setId_igraca2($id_igraca2);

                $rezervacija->setId_terena($id_terena);
                $rezervacija->setId_meca($id_meca);
                $rezervacija->setDatum($datum);
                $rezervacija->setVreme($vreme);
                //print_r($rezervacija);
                $rezervacijeDAO = new RezervacijeDAO();
                $poruka = $rezervacijeDAO->InsertRezervacije($rezervacija);
                session_start();
                $_SESSION['msg'] = $poruka;
                if ($poruka == 'Uspešno ste rezervisali') {
                    header("Location:../view-klubovi/rezervacije.php");
                } else {
                    header("Location:../view-klubovi/formaInsertRezervacijaSingle.php");
                }
            } else {
                session_start();
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-klubovi/formaInsertRezervacijaSingle.php");
            }
        }
    }
    public function PonistiRezervaciju($id, $id_terena)
    {
        $rezervacijeDAO = new RezervacijeDAO();
        $poruka = $rezervacijeDAO->DeleteRezervacije($id, $id_terena);
        session_start();
        $_SESSION['msg'] = $poruka;
        header("Location:../view-klubovi/rezervacije.php");
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
