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
        session_unset();
        session_destroy();
        header("Location:../view-admin/loginadmin.php");
    }
    public function Login()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['prijavi'] == 'Prijava') {
                $email = isset($_POST['email']) ? $this->test_input($_POST['email']) : '';
                $lozinka = isset($_POST['lozinka']) ? $this->test_input($_POST['lozinka']) : '';
                if (!empty($email) && !empty($lozinka)) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $korisnikDAO = new KorisnikDAO();
                        $korisnik = $korisnikDAO->LoginAdmin($email, $lozinka);
                        if ($korisnik != new Korisnik()) {
                            $_SESSION['loginA'] = serialize($korisnik);
                            $_SESSION['last_active'] = time();
                            header("Location:../view-admin/pocetna.php");
                        } else {
                            $msg = 'Uneli ste pogrešnu email adresu i lozinku';
                            $_SESSION['msg'] = $msg;
                            header("Location:../view-admin/loginadmin.php");
                        }
                    } else {
                        $msg = "Uneli ste pogrešan format za email";
                        $_SESSION['msg'] = $msg;
                        header("Location:../view-admin/loginadmin.php");
                    }
                } else {
                    $msg = 'Morate uneti email i lozinku';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-admin/loginadmin.php");
                }
            }
        }
    }
}
