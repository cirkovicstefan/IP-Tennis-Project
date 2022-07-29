<?php
require_once '../model/Korisnik.php';
require_once '../DAO/KorisnikDAO.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $ime = isset($_POST['ime']) ? test_input($_POST['ime']) : '';
    $prezime = isset($_POST['prezime']) ? test_input($_POST['prezime']) : '';
    $korisnikDAO = new KorisnikDAO();
    $igraci = $korisnikDAO->getAllIgraci();
    session_start();
    foreach ($igraci as $item) {
        if ($item['ime'] == $ime && $item['prezime'] == $prezime) {
            $igrac = $item;
            if (!isset($_SESSION['lista']))
                $_SESSION['lista'] = array();
            $_SESSION['lista'][] = $igrac;
            header('Location:../view-gosti/favoritePlayers.php');
            break;
        } else {
            $msg = 'Igrac sa unetim imenom i prezimenom ne postoji';
            $_SESSION['msg'] = $msg;
            header('Location:../view-gosti/formaAddOmiljeniIgrac.php');
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
