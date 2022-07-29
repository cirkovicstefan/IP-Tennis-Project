<?php

use LDAP\Result;

require_once '../DAO/PregledRezultataDAO.php';
require_once '../model/PregledRezultata.php';
require_once '../DAO/TerenDAO.php';
require_once '../DAO/RezervacijeDAO.php';
require_once '../DAO/KorisnikDAO.php';

class RezultatiController
{
    public function InsertPregledRezultata()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $rezultat = isset($_POST['rezultat']) ? $this->test_input($_POST['rezultat']) : '';
            $potvrda_rezultata = isset($_POST['potvrda_rezultata']) ? $this->test_input($_POST['potvrda_rezultata']) : '';
            $id_rezervacije = isset($_POST['id_rezervacije']) ? $this->test_input($_POST['id_rezervacije']) : '';
            $status_meca = isset($_POST['status_meca']) ? $this->test_input($_POST['status_meca']) : '';
            if ($potvrda_rezultata == 'on') {
                $potvrda_rezultata = true;
            } else {
                $potvrda_rezultata = false;
            }

            $rezultatObj = new PregledRezultata();
            $rezultatObj->setRezultat($rezultat);
            $rezultatObj->setPotvrda_rezultata($potvrda_rezultata);
            $rezultatObj->setId_rezervacije($id_rezervacije);
            $rezultatObj->setStatus_meca($status_meca);
            session_start();
            $_SESSION['rezultat'] = serialize($rezultatObj);

            if (!empty($rezultat)  && !empty($id_rezervacije) && !empty($status_meca)) {
                if (preg_match('((\d{1})-\d{1}$)', $rezultat)) {
                    $pregDAO = new PregledRezultataDAO();
                    $rezultatObj = new PregledRezultata();
                    $rezultatObj->setRezultat($rezultat);
                    $rezultatObj->setPotvrda_rezultata($potvrda_rezultata);
                    $rezultatObj->setId_rezervacije($id_rezervacije);
                    $rezultatObj->setStatus_meca($status_meca);
                    $rezervacijeDAO = new RezervacijeDAO();
                    $rezervacija = $rezervacijeDAO->getRezervacijeById($rezultatObj->getId_rezervacije());


                    if (substr($rezultat, 0, 1) > substr($rezultat, 2, 1)) {
                        if ($rezervacija['id_igraca3'] != NULL && $rezervacija['id_igraca4'] != NULL) {
                            $id_igrac1 = $rezervacija['id_igraca1'];
                            $id_igrac2 = $rezervacija['id_igraca2'];
                            $id_igrac3 = $rezervacija['id_igraca3'];
                            $id_igrac4 = $rezervacija['id_igraca4'];
                            $igracKorisnkDAO = new KorisnikDAO();
                            $igracKorisnkDAO->SetPobede($id_igrac1);
                            $igracKorisnkDAO->SetPobede($id_igrac2);
                            $igracKorisnkDAO->SetPorazi($id_igrac3);
                            $igracKorisnkDAO->SetPorazi($id_igrac4);
                        } else {
                            $id_igrac1 = $rezervacija['id_igraca1'];
                            $id_igrac2 = $rezervacija['id_igraca2'];
                            $igracKorisnkDAO = new KorisnikDAO();
                            $igracKorisnkDAO->SetPobede($id_igrac1);
                            $igracKorisnkDAO->SetPorazi($id_igrac2);
                        }
                    } else {
                        if ($rezervacija['id_igraca3'] != NULL && $rezervacija['id_igraca4'] != NULL) {
                            $id_igrac1 = $rezervacija['id_igraca1'];
                            $id_igrac2 = $rezervacija['id_igraca2'];
                            $id_igrac3 = $rezervacija['id_igraca3'];
                            $id_igrac4 = $rezervacija['id_igraca4'];
                            $igracKorisnkDAO = new KorisnikDAO();

                            $igracKorisnkDAO->SetPorazi($id_igrac1);
                            $igracKorisnkDAO->SetPorazi($id_igrac2);
                            $igracKorisnkDAO->SetPobede($id_igrac3);
                            $igracKorisnkDAO->SetPobede($id_igrac4);
                        } else {
                            $id_igrac1 = $rezervacija['id_igracа1'];
                            $id_igrac2 = $rezervacija['id_igracа2'];
                            $igracKorisnkDAO = new KorisnikDAO();
                            $igracKorisnkDAO->SetPobede($id_igrac2);
                            $igracKorisnkDAO->SetPorazi($id_igrac1);
                        }
                    }


                    if ($potvrda_rezultata == true) {
                        $terenDAO = new TerenDAO();
                        $terenDAO->SetZauzetostTerena($rezervacija['id_terena'], false);
                    }

                    $poruka = $pregDAO->InsertPregledRezultata($rezultatObj);
                    $_SESSION['msg'] = $poruka;
                    header("Location:../view-admin/rezultati.php");
                } else {
                    $msg = 'Pogrešan format rezultata';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-admin/formaUpdateRezultati.php");
                }
            } else {
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-admin/formaInsertRezultati.php");
            }
        }
    }


    public function DeletePregledRezultata($id)
    {
        $pregDAO = new PregledRezultataDAO();
        $res = $pregDAO->DeletePregledRezultata($id);
        $msg = $res;
        session_start();
        $_SESSION['msg'] = $msg;
        header("Location:../view-admin/rezultati.php");
    }

    public function UpdatePregledRezultata()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $rezultat = isset($_POST['rezultat']) ? $this->test_input($_POST['rezultat']) : '';
            $potvrda_rezultata = isset($_POST['potvrda_rezultata']) ? $this->test_input($_POST['potvrda_rezultata']) : '';
            $id_rezervacije = isset($_POST['id_rezervacije']) ? $this->test_input($_POST['id_rezervacije']) : '';
            $status_meca = isset($_POST['status_meca']) ? $this->test_input($_POST['status_meca']) : '';

            $id =  isset($_POST['id']) ? $this->test_input($_POST['id']) : "";

            if ($potvrda_rezultata == 'on') {
                $potvrda_rezultata = true;
            } else {
                $potvrda_rezultata = false;
            }



            session_start();

            $_SESSION['rezultat1'] = array();
            $_SESSION['rezultat1']['id'] = $id;
            $_SESSION['rezultat1']['rezultat'] = $rezultat;
            $_SESSION['rezultat1']['potvrda_rezultata'] = $potvrda_rezultata;
            $_SESSION['rezultat1']['id_rezervacije'] = $id_rezervacije;
            $_SESSION['rezultat1']['status_meca'] = $status_meca;

            if (!empty($rezultat)  && !empty($id_rezervacije) && !empty($status_meca)) {
                if (preg_match('((\d{1})-\d{1}$)', $rezultat)) {
                    $pregledRezultataDAO = new PregledRezultataDAO();
                    $rezultatObj = new PregledRezultata();

                    $rezultatObj->setRezultat($rezultat);
                    $rezultatObj->setPotvrda_rezultata($potvrda_rezultata);
                    $rezultatObj->setId_rezervacije($id_rezervacije);
                    $rezultatObj->setStatus_meca($status_meca);
                    $rezervacijeDAO = new RezervacijeDAO();
                    $rezervacija = $rezervacijeDAO->getRezervacijeById($rezultatObj->getId_rezervacije());
                    if (substr($rezultat, 0, 1) > substr($rezultat, 2, 1)) {
                        if ($rezervacija['id_igraca3'] != NULL && $rezervacija['id_igraca4'] != NULL) {
                            $id_igrac1 = $rezervacija['id_igraca1'];
                            $id_igrac2 = $rezervacija['id_igraca2'];
                            $id_igrac3 = $rezervacija['id_igraca3'];
                            $id_igrac4 = $rezervacija['id_igraca4'];
                            $igracKorisnkDAO = new KorisnikDAO();
                            $igracKorisnkDAO->SetPobede($id_igrac1);
                            $igracKorisnkDAO->SetPobede($id_igrac2);
                            $igracKorisnkDAO->SetPorazi($id_igrac3);
                            $igracKorisnkDAO->SetPorazi($id_igrac4);
                        } else {
                            $id_igrac1 = $rezervacija['id_igraca1'];
                            $id_igrac2 = $rezervacija['id_igraca2'];
                            $igracKorisnkDAO = new KorisnikDAO();
                            $igracKorisnkDAO->SetPobede($id_igrac1);
                            $igracKorisnkDAO->SetPorazi($id_igrac2);
                        }
                    } else {
                        if ($rezervacija['id_igraca3'] != NULL && $rezervacija['id_igraca4'] != NULL) {
                            $id_igrac1 = $rezervacija['id_igraca1'];
                            $id_igrac2 = $rezervacija['id_igraca2'];
                            $id_igrac3 = $rezervacija['id_igraca3'];
                            $id_igrac4 = $rezervacija['id_igraca4'];
                            $igracKorisnkDAO = new KorisnikDAO();

                            $igracKorisnkDAO->SetPorazi($id_igrac1);
                            $igracKorisnkDAO->SetPorazi($id_igrac2);
                            $igracKorisnkDAO->SetPobede($id_igrac3);
                            $igracKorisnkDAO->SetPobede($id_igrac4);
                        } else {
                            $id_igrac1 = $rezervacija['id_igraca1'];
                            $id_igrac2 = $rezervacija['id_igraca2'];
                            $igracKorisnkDAO = new KorisnikDAO();
                            $igracKorisnkDAO->SetPobede($id_igrac2);
                            $igracKorisnkDAO->SetPorazi($id_igrac1);
                        }
                    }
                    if ($potvrda_rezultata == true) {
                        $terenDAO = new TerenDAO();
                        $terenDAO->SetZauzetostTerena($rezervacija['id_terena'], false);
                    } else {
                        $terenDAO = new TerenDAO();
                        $terenDAO->SetZauzetostTerena($rezervacija['id_terena'], true);
                    }

                    $pregledRezultataDAO->UpdatePregledRezultata($id, $rezultatObj);
                    header("Location:../view-admin/rezultati.php");
                } else {
                    $msg = 'Pogrešan format rezultata';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-admin/formaUpdateRezultati.php");
                }
            } else {
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-admin/formaUpdateRezultati.php");
            }
        }
    }

    public function EditRezultati($id)
    {
        $pregDAO = new PregledRezultataDAO();
        $rezultat = $pregDAO->getPregledById($id);
        session_start();
        $_SESSION['rezultat1'] = $rezultat;
        header("Location:../view-admin/formaUpdateRezultati.php");
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
