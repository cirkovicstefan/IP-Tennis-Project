<?php
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';
class ControllerLogin
{

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function Logout()
    {
        session_start();
        //unset($_SESSION['loginK']);
        session_unset();
        session_destroy();
        header("Location:../view-klubovi/login.php");
    }
    public function Login()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['prijavi'] == 'Prijava') {
                $email = isset($_POST['email']) ? $this->test_input($_POST['email']) : '';
                $lozinka = isset($_POST['lozinka']) ? $this->test_input($_POST['lozinka']) : '';
                $zapanti_ime = isset($_POST['zapanti_ime']) ? $this->test_input($_POST['zapanti_ime']) : '';
                if (!empty($email) && !empty($lozinka)) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $korisnikDAO = new KorisnikDAO();
                        $korisnik = $korisnikDAO->LoginKlub($email, $lozinka);
                        if ($korisnik != new Korisnik()) {
                            if ($zapanti_ime == 'on') {
                                setcookie('korisnicko_ime', serialize($email), time() + 60 * 60 * 24, "/");
                            }
                            // print_r($_COOKIE);
                            $_SESSION['loginK'] = serialize($korisnik);
                            $_SESSION['last_active1'] = time();
                            header("Location:../view-klubovi/pocetna.php");
                        } else {
                            $msg = 'Uneli ste pogrešnu email adresu i lozinku';
                            $_SESSION['msg'] = $msg;
                            header("Location:../view-klubovi/login.php");
                        }
                    } else {
                        $msg = "Uneli ste pogrešan format za email";
                        $_SESSION['msg'] = $msg;
                        header("Location:../view-klubovi/login.php");
                    }
                } else {
                    $msg = 'Morate uneti email i lozinku';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-klubovi/login.php");
                }
            }
        }
    }
}
