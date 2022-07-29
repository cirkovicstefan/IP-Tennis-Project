<?php
require_once '../model/Korisnik.php';
require_once '../DAO/KorisnikDAO.php';
class IgraciController
{
    public function InsertIgrac()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $ime = isset($_POST['ime']) ? $this->test_input($_POST['ime']) : '';
            $prezime = isset($_POST['prezime']) ? $this->test_input($_POST['prezime']) : '';
            $pol = isset($_POST['pol']) ? $this->test_input($_POST['pol']) : '';
            $visina = isset($_POST['visina']) ? $this->test_input($_POST['visina']) : '';
            $godine = isset($_POST['godine']) ? $this->test_input($_POST['godine']) : '';
            $pobede = isset($_POST['pobeda']) ? $this->test_input($_POST['pobeda']) : '';
            $porazi = isset($_POST['porazi']) ? $this->test_input($_POST['porazi']) : "";
            $email = isset($_POST['email']) ? $this->test_input($_POST['email']) : "";
            $lozinka = isset($_POST['lozinka']) ? $this->test_input($_POST['lozinka']) : "";

            $igrac = new Korisnik();
            $igrac->setIme($ime);
            $igrac->setPrezime($prezime);
            $igrac->setPol($pol);
            $igrac->setVisina($visina);
            $igrac->setGodine($godine);
            $igrac->setPobede($pobede);
            $igrac->setPorazi($porazi);
            $igrac->setEmail($email);
            $igrac->setLozinka($lozinka);
            session_start();
            $_SESSION['igrac'] = serialize($igrac);
            if (!empty($ime) && !empty($prezime) && !empty($pol) && !empty($visina)  && !empty($godine)  && !empty($email) && !empty($lozinka)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if (is_numeric($visina)) {
                        if (is_numeric($godine)) {
                            if (is_numeric($pobede)) {
                                if (is_numeric($porazi)) {
                                    if (strlen($lozinka) > 8) {
                                        $igrac = new Korisnik();
                                        $igrac->setIme($ime);
                                        $igrac->setPrezime($prezime);
                                        $igrac->setPol($pol);
                                        $igrac->setVisina($visina);
                                        $igrac->setGodine($godine);
                                        $igrac->setPobede($pobede);
                                        $igrac->setPorazi($porazi);
                                        $igrac->setEmail($email);
                                        $igrac->setLozinka(md5($lozinka));
                                        $igrac->setIdUloge(1);
                                        $korisnikDAO = new KorisnikDAO();
                                        $ind = $korisnikDAO->InsertKorisnik($igrac);
                                        if ($ind == true) {
                                            header("Location:../view-klubovi/igraci.php");
                                        } else {
                                            $msg = 'Greška';
                                            $_SESSION['msg'] = $msg;
                                            header("Location:../view-klubovi/formaInsertIgraci.php");
                                        }
                                    } else {
                                        $msg = 'Lozinka mora biti veća od 8 karaktera';
                                        $_SESSION['msg'] = $msg;
                                        header("Location:../view-klubovi/formaInsertIgraci.php");
                                    }
                                } else {
                                    $msg = 'Porazi su numerička vrednost';
                                    $_SESSION['msg'] = $msg;
                                    header("Location:../view-klubovi/formaInsertIgraci.php");
                                }
                            } else {
                                $msg = 'Pobeda je numerička vrednost';
                                $_SESSION['msg'] = $msg;
                                header("Location:../view-klubovi/formaInsertIgraci.php");
                            }
                        } else {
                            $msg = 'Godina je numerička vrednost';
                            $_SESSION['msg'] = $msg;
                            header("Location:../view-klubovi/formaInsertIgraci.php");
                        }
                    } else {
                        $msg = 'Visina je numerička vrednost';
                        $_SESSION['msg'] = $msg;
                        header("Location:../view-klubovi/formaInsertIgraci.php");
                    }
                } else {
                    $msg = 'Pogrešan format email';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-klubovi/formaInsertIgraci.php");
                }
            } else {
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-klubovi/formaInsertIgraci.php");
            }
        }
    }
    public function EditIgrac($id)
    {
        $korisnkDAO = new KorisnikDAO();
        $igrac = $korisnkDAO->getAllIgraciById($id);
        session_start();
        $_SESSION['igrac1'] = ($igrac);
        header("Location:../view-klubovi/formaUpdateIgraci.php");
    }

    public function UpdateIgrac()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $ime = isset($_POST['ime']) ? $this->test_input($_POST['ime']) : '';
            $prezime = isset($_POST['prezime']) ? $this->test_input($_POST['prezime']) : '';
            $pol = isset($_POST['pol']) ? $this->test_input($_POST['pol']) : '';
            $visina = isset($_POST['visina']) ? $this->test_input($_POST['visina']) : '';
            $godine = isset($_POST['godine']) ? $this->test_input($_POST['godine']) : '';
            $pobede = isset($_POST['pobeda']) ? $this->test_input($_POST['pobeda']) : '';
            $porazi = isset($_POST['porazi']) ? $this->test_input($_POST['porazi']) : "";
            $email = isset($_POST['email']) ? $this->test_input($_POST['email']) : "";
            $lozinka = isset($_POST['lozinka']) ? $this->test_input($_POST['lozinka']) : "";
            $id = isset($_POST['id']) ? $this->test_input($_POST['id']) : "";

            $igrac = new Korisnik();
            $igrac->setId($id);
            $igrac->setIme($ime);
            $igrac->setPrezime($prezime);
            $igrac->setPol($pol);
            $igrac->setVisina($visina);
            $igrac->setGodine($godine);
            $igrac->setPobede($pobede);
            $igrac->setPorazi($porazi);
            $igrac->setEmail($email);
            $igrac->setLozinka($lozinka);
            session_start();
            $_SESSION['igrac1'] = array();
            $_SESSION['igrac1']['id'] = $id;
            $_SESSION['igrac1']['ime'] = $ime;
            $_SESSION['igrac1']['prezime'] = $prezime;
            $_SESSION['igrac1']['pol'] = $pol;
            $_SESSION['igrac1']['visina'] = $visina;
            $_SESSION['igrac1']['godine'] = $godine;
            $_SESSION['igrac1']['pobeda'] = $pobede;
            $_SESSION['igrac1']['porazi'] = $porazi;
            $_SESSION['igrac1']['email'] = $email;
            $_SESSION['igrac1']['lozinka'] = $lozinka;

            if (!empty($ime) && !empty($prezime) && !empty($pol) && !empty($visina)  && !empty($godine)  && !empty($email) && !empty($lozinka)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if (is_numeric($visina)) {
                        if (is_numeric($godine)) {
                            if (is_numeric($pobede)) {
                                if (is_numeric($porazi)) {
                                    if (strlen($lozinka) > 8) {
                                        $igrac = new Korisnik();
                                        $igrac->setId($id);
                                        $igrac->setIme($ime);
                                        $igrac->setPrezime($prezime);
                                        $igrac->setPol($pol);
                                        $igrac->setVisina($visina);
                                        $igrac->setGodine($godine);
                                        $igrac->setPobede($pobede);
                                        $igrac->setPorazi($porazi);
                                        $igrac->setEmail($email);
                                        $igrac->setLozinka(md5($lozinka));
                                        $igrac->setIdUloge(1);
                                        $korisnikDAO = new KorisnikDAO();
                                        $ind = $korisnikDAO->UpdateKorisnik($id, $igrac);
                                        if ($ind == true) {
                                            header("Location:../view-klubovi/igraci.php");
                                        } else {
                                            $msg = 'Greška';
                                            $_SESSION['msg'] = $msg;
                                            header("Location:../view-klubovi/formaUpdateIgraci.php");
                                        }
                                    } else {
                                        $msg = 'Lozinka mora biti veća od 8 karaktera';
                                        $_SESSION['msg'] = $msg;
                                        header("Location:../view-klubovi/formaUpdateIgraci.php");
                                    }
                                } else {
                                    $msg = 'Porazi su numerička vrednost';
                                    $_SESSION['msg'] = $msg;
                                    header("Location:../view-klubovi/formaUpdateIgraci.php");
                                }
                            } else {
                                $msg = 'Pobeda je numerička vrednost';
                                $_SESSION['msg'] = $msg;
                                header("Location:../view-klubovi/formaUpdateIgraci.php");
                            }
                        } else {
                            $msg = 'Godina je numerička vrednost';
                            $_SESSION['msg'] = $msg;
                            header("Location:../view-klubovi/formaUpdateIgraci.php");
                        }
                    } else {
                        $msg = 'Visina je numerička vrednost';
                        $_SESSION['msg'] = $msg;
                        header("Location:../view-klubovi/formaUpdateIgraci.php");
                    }
                } else {
                    $msg = 'Pogrešan format email';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-klubovi/formaUpdateIgraci.php");
                }
            } else {
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-klubovi/formaUpdateIgraci.php");
            }
        }
    }
    public function DeleteIgrac($id)
    {
        $korisnikDAO = new KorisnikDAO();
        $poruka = $korisnikDAO->DeleteKorisnik($id);

        session_start();
        $_SESSION['msg'] = $poruka;
        header("Location:../view-klubovi/igraci.php");
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
