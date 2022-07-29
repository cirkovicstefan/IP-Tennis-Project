<?php
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

class LoginIgraciController {
    public function loginIgraci() 
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['Prijava'] == 'Prijava') {
                $email = isset($_POST['email']) ? $this->testInput($_POST['email']) : " ";
                $lozinka = isset($_POST['lozinka']) ? $this->testInput($_POST['lozinka']) : " ";
                if (!empty($email) && !empty($lozinka)) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $korisnikDAO = new KorisnikDAO();
                        $korisnik = $korisnikDAO->LoginIgrac($email, $lozinka);
                        if ($korisnik != new Korisnik()) {
                            $_SESSION['loginKorisnik'] = serialize($korisnik);
                            $_SESSION['last_active'] = time();
                            header('Location: ../view-igraci/pocetnaIgraci.php');
                        } 
                      

                        else {
                            $msg = 'Uneli ste pogresnu email adresu ili lozinku';
                            $_SESSION['msg'] =  $msg;

                            header('Location: ../view-igraci/loginIgraci.php');
                        }
                    } }
                    else {
                        $msg = "Uneli ste pogresan email format";
                        $_SESSION['msg'] =  $msg;

                        header('Location: ../view-igraci/loginIgraci.php');
                    }
                }
                 else {
                    $msg= 'Polje email i lozinka moraju biti popunjeni!';
                    $_SESSION['msg'] =  $msg;

                    header('Location: ../view-igraci/loginIgraci.php');
                }
            }
    }
    public function logoutIgraci()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../view-igraci/loginIgraci.php');
    }

    function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
?>
