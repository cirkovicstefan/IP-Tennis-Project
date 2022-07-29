<?php
require_once '../model/Korisnik.php';
require_once '../DAO/KorisnikDAO.php';
class ControllerKorisnikKluba
{
    public function InsertKorisnikKluba()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $ime = isset($_POST['ime']) ? $this->test_input($_POST['ime']) : '';
            $prezime = isset($_POST['prezime']) ? $this->test_input($_POST['prezime']) : '';
            $email = isset($_POST['email']) ? $this->test_input($_POST['email']) : "";
            $lozinka = isset($_POST['lozinka']) ? $this->test_input($_POST['lozinka']) : "";
            $naziv_kluba = isset($_POST['naziv_kluba']) ? $this->test_input($_POST['naziv_kluba']) : "";

            $korisnik_kluba = new Korisnik();
            $korisnik_kluba->setIme($ime);
            $korisnik_kluba->setPrezime($prezime);
            $korisnik_kluba->setEmail($email);
            $korisnik_kluba->setLozinka($lozinka);
            $korisnik_kluba->setNazivKluba($naziv_kluba);
            session_start();
            $_SESSION['kklub'] = serialize($korisnik_kluba);
            if (!empty($ime) && !empty($prezime) && !empty($email) && !empty($lozinka) && !empty($naziv_kluba)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if (strlen($lozinka) > 8) {
                        $korisnik_kluba = new Korisnik();
                        $korisnik_kluba->setIme($ime);
                        $korisnik_kluba->setPrezime($prezime);
                        $korisnik_kluba->setEmail($email);
                        $korisnik_kluba->setLozinka(md5($lozinka));
                        $korisnik_kluba->setNazivKluba($naziv_kluba);
                        $korisnik_kluba->setIdUloge(3);
                        $korisnikDAO = new KorisnikDAO();
                        $ind = $korisnikDAO->InsertKorisnik($korisnik_kluba);
                        if ($ind == true) {
                            header("Location:../view-admin/korisniciKluba.php");
                        } else {
                            $msg = 'Greška';
                            $_SESSION['msg'] = $msg;
                            header("Location:../view-admin/formaInsertKorisnik.php");
                        }
                    } else {
                        $msg = 'Lozinka mora biti veća od 8 karaktera';
                        $_SESSION['msg'] = $msg;
                        header("Location:../view-admin/formaInsertKorisnik.php");
                    }
                } else {
                    $msg = 'Pogrešan format email';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-admin/formaInsertKorisnik.php");
                }
            } else {
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-admin/formaInsertKorisnik.php");
            }
        }
    }
    public function EditKorisnikKluba($id)
    {
        $korisnkDAO = new KorisnikDAO();
        $korisnik_kluba = $korisnkDAO->getKluboviKorisniciById($id);
        session_start();
        $_SESSION['kklub1'] = ($korisnik_kluba);
        header("Location:../view-admin/formaUpdateKorisnik.php");
    }

    public function UpdateKorisnikKluba()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $ime = isset($_POST['ime']) ? $this->test_input($_POST['ime']) : '';
            $prezime = isset($_POST['prezime']) ? $this->test_input($_POST['prezime']) : '';
            $email = isset($_POST['email']) ? $this->test_input($_POST['email']) : "";
            $lozinka = isset($_POST['lozinka']) ? $this->test_input($_POST['lozinka']) : "";
            $naziv_kluba = isset($_POST['naziv_kluba']) ? $this->test_input($_POST['naziv_kluba']) : "";
            $id = isset($_POST['id']) ? $this->test_input($_POST['id']) : "";

            $korisnik_kluba = new Korisnik();
            $korisnik_kluba->setId($id);
            $korisnik_kluba->setIme($ime);
            $korisnik_kluba->setPrezime($prezime);
            $korisnik_kluba->setEmail($email);
            $korisnik_kluba->setLozinka($lozinka);
            $korisnik_kluba->setNazivKluba($naziv_kluba);
            session_start();
            $_SESSION['kklub1'] = array();
            $_SESSION['kklub1']['id'] = $id;
            $_SESSION['kklub1']['ime'] = $ime;
            $_SESSION['kklub1']['prezime'] = $prezime;
            $_SESSION['kklub1']['email'] = $email;
            $_SESSION['kklub1']['lozinka'] = $lozinka;
            $_SESSION['kklub1']['naziv_kluba'] = $naziv_kluba;
            $_SESSION['kklub1']['id'] = $id;

            if (!empty($ime) && !empty($prezime) && !empty($email) && !empty($lozinka) && !empty($naziv_kluba)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if (strlen($lozinka) > 8) {
                        $korisnik_kluba = new Korisnik();
                        $korisnik_kluba->setIme($ime);
                        $korisnik_kluba->setPrezime($prezime);
                        $korisnik_kluba->setEmail($email);
                        $korisnik_kluba->setLozinka(md5($lozinka));
                        $korisnik_kluba->setNazivKluba($naziv_kluba);
                        $korisnik_kluba->setIdUloge(3);
                        $korisnikDAO = new KorisnikDAO();
                        $ind = $korisnikDAO->UpdateKorisnik($id, $korisnik_kluba);
                        if ($ind == true) {
                            header("Location:../view-admin/korisniciKluba.php");
                        } else {
                            $msg = 'Greška';
                            $_SESSION['msg'] = $msg;
                            header("Location:../view-admin/formaUpdateKorisnik.php");
                        }
                    } else {
                        $msg = 'Lozinka mora biti veća od 8 karaktera';
                        $_SESSION['msg'] = $msg;
                        header("Location:../view-admin/formaUpdateKorisnik.php");
                    }
                } else {
                    $msg = 'Pogrešan format email';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-admin/formaUpdateKorisnik.php");
                }
            } else {
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-admin/formaUpdateKorisnik.php");
            }
        }
    }
    public function DeleteKorisnikKluba($id)
    {
        $korisnikDAO = new KorisnikDAO();
        $poruka = $korisnikDAO->DeleteKorisnik($id);

        session_start();
        $_SESSION['msg'] = $poruka;
        header("Location:../view-admin/korisniciKluba.php");
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
