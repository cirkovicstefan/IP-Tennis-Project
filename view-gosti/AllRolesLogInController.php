<?php
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

//potrebno je da se view gosti home.php otvara default
//da se doda log in na vrhu menija
// submit na log in formi da vodi na odgovarajuću stranu u zavisnosti od uloge

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
                        $korisnik = $korisnikDAO->LoginKlub($email, $lozinka);
                        if ($korisnik != new Korisnik() && $korisnik['id_uloge'] == 1 ) {
                            $_SESSION['loginKorisnik'] = serialize($korisnik);
                            $_SESSION['last_active'] = time();
                            header("Location:../view-igraci/pocetnaIgraci.php");
                        } 
                        else if ($korisnik != new Korisnik() && $korisnik['id_uloge'] == 3 ) {
                            $_SESSION['loginKorisnik'] = serialize($korisnik);
                            $_SESSION['last_active'] = time();
                            header("Location:../view-klubovi/pocetna.php");
                        } 
                        else if ($korisnik != new Korisnik() && $korisnik['id_uloge'] == 2 ) {
                            $_SESSION['loginKorisnik'] = serialize($korisnik);
                            $_SESSION['last_active'] = time();
                            header("Location:../view-admin/loginadmin.php");
                        } 
                        else {
                            header("Location:../view-gosti/home.php");
                        }
                    }
                        else {
                            $message = 'Uneli ste pogresnu email adresu ili lozinku';
                            $_SESSION['message'] =  $message;
                            header('Location: ../view-igraci/loginIgraci.php');
                        }
                    } 
                    else {
                        $message = "Uneli ste pogresan email format";
                        $_SESSION['message'] =  $message;

                        header('Location: ../view-igraci/loginIgraci.php');
                    }
                }
                 else {
                    $message= 'Polje email i lozinka moraju biti popunjeni!';
                    $_SESSION['message'] =  $message;

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
