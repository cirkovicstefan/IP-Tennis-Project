<?php

require_once "../DAO/KorisnikDAO.php";
require_once '../model/Korisnik.php';
$msg = "";
class ControllerIgraci
{
    public function InsertIgrac()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ime = isset($_POST["ime"]) ? $this->test_input($_POST["ime"]) : "";
            echo "Ime " . $ime;
            $prezime = isset($_POST["prezime"]) ? $this->test_input($_POST["prezime"]) : "";
            echo "Prezime " . $prezime;
            $visina = isset($_POST["visina"]) ? $this->test_input($_POST["visina"]) : "";
            echo "Visina " . $visina;
            $godine = isset($_POST["godine"]) ? $this->test_input($_POST["godine"]) : "";
            echo "Godine " . $godine . "nekk";
            $pol = isset($_POST["inlineRadioOptions"]) ? $this->test_input($_POST["inlineRadioOptions"]) : "";
            if ($pol == "option1")
                $pol = "Zenski";
            elseif ($pol == "option2")
                $pol = "Muski";
            echo "Pol " . $pol . "nekk";
            $email = isset($_POST["email"]) ? $this->test_input($_POST["email"]) : "";
            echo "Email " . $email;
            $lozinka = isset($_POST["lozinka"]) ? $this->test_input($_POST["lozinka"]) : "";
            echo "Lozinka " . $lozinka;
            $nazivkluba = isset($_POST["nazivkluba"]) ? $this->test_input($_POST["nazivkluba"]) : "";
            echo "nazivkl " . $nazivkluba;
            $action = isset($_POST["action"]) ? $this->test_input($_POST["action"]) : "";

            $korisnik = new Korisnik;
            $korisnik->setIme($ime);
            $korisnik->setPrezime($prezime);
            $korisnik->setPol($pol);
            $korisnik->setVisina($visina);
            $korisnik->setGodine($godine);
            $korisnik->setPobede(null);
            $korisnik->setPorazi(null);
            $korisnik->setNazivKluba($nazivkluba);
            $korisnik->setEmail($email);
            $korisnik->setLozinka($lozinka);
            $korisnik->setIdUloge(1);

            session_start();
            $_SESSION['igrac'] = serialize($korisnik);
            $korisnikDao = new KorisnikDAO;

            if (
                $action == "Potvrdi" && !empty($ime) && !empty($prezime) && !empty($visina) && !empty($godine)
                && !empty($pol) && !empty($email) && !empty($lozinka) && !empty($nazivkluba)
            ) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    if (is_numeric($visina)) {
                        if (is_numeric($godine)) {
                            if (strlen($lozinka) > 8) {

                                $korisnik = new Korisnik;
                                $korisnik->setIme($ime);
                                $korisnik->setPrezime($prezime);
                                $korisnik->setPol($pol);
                                $korisnik->setVisina($visina);
                                $korisnik->setGodine($godine);
                                $korisnik->setPobede(null);
                                $korisnik->setPorazi(null);
                                $korisnik->setNazivKluba($nazivkluba);
                                $korisnik->setEmail($email);
                                $korisnik->setLozinka(md5($lozinka));
                                $korisnik->setIdUloge(1);


                                $uspesno =  $korisnikDao->insertKorisnik($korisnik);
                                $msg = "Sva polja su odgovarajuća";
                                header("Location: ../view-igraci/loginIgraci.php");
                            } else {
                                $msg = 'Lozinka mora biti veća od 8 karaktera';
                                $_SESSION['msg'] = $msg;
                                header("Location:../view-igraci/RegistracijaIgraci.php");
                            }
                        } else {
                            $msg = 'Morate uneti numeričku vrednost za godine';
                            $_SESSION['msg'] = $msg;
                            header("Location:../view-igraci/RegistracijaIgraci.php");
                        }
                    } else {
                        $msg = 'Morate uneti numeričku vrednost za visinu';
                        $_SESSION['msg'] = $msg;
                        header("Location:../view-igraci/RegistracijaIgraci.php");
                    }
                } else {
                    $msg = 'Pogrešan format emaila';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-igraci/RegistracijaIgraci.php");
                }
            } else {
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-igraci/RegistracijaIgraci.php");
            }
        }
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
