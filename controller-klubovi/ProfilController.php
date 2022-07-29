<?php
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'edit') {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $ime = isset($_POST['ime']) ? test_input($_POST['ime']) : '';
        $prezime = isset($_POST['prezime']) ? test_input($_POST['prezime']) : '';
        $email = isset($_POST['email']) ? test_input($_POST['email']) : '';
        $id = isset($_POST['id']) ? test_input($_POST['id']) : '';

        //print_r($_FILES);
        $niz['slika']['name'] = '';
        $niz['slika']['full_path'] = '';
        $niz['slika']['type'] = '';
        $niz['slika']['tmp_name'] = '';
        $niz['slika']['error'] = 4;
        $niz['slika']['size'] = 0;
        if ($_FILES != $niz) {
            $slika = fopen($_FILES['slika']['tmp_name'], 'rb');
        } else {

            $korinsikDAOBY = new KorisnikDAO();
            $temp = $korinsikDAOBY->getKluboviKorisniciById($id);
            $slika =  $temp['profilna_slika'];
        }


        if (!empty($ime) && !empty($prezime) && !empty($email) && !empty($id)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $korisnikDAO = new KorisnikDAO();
                $korisnik = new Korisnik();
                $korisnik->setIme($ime);
                $korisnik->setPrezime($prezime);
                $korisnik->setEmail($email);
                $korisnik->setProfilnaSlika($slika);
                $res = $korisnikDAO->UpdateKorisnikProfil($id, $korisnik);
                if ($res == true) {
                    session_start();
                    session_unset();
                    session_destroy();
                    header("Location:../view-klubovi/login.php");
                } else {
                    header("Location:../view-klubovi/profil.php");
                }
            } else {
                $msg = "Uneli ste pogrešan format za email";
                $_SESSION['msg'] = $msg;
                header("Location:../view-klubovi/profil.php");
            }
        } else {
            $msg = "Morate pop";
            $_SESSION['msg'] = $msg;
            header("Location:../view-klubovi/profil.php");
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
