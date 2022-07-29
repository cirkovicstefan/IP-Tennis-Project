<?php
require_once '../model/SportiskiKlub.php';
require_once '../DAO/SportskiKlubDAO.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $naziv = isset($_POST['naziv']) ? test_input($_POST['naziv']) : '';
    $klubDAO = new SportskiKlubDAO();
    $klubovi = $klubDAO->getAllSportskiKlubovi();
    session_start();
    foreach ($klubovi as $item) {
        if ($item['naziv'] == $naziv) {
            $klub = $item;
            if(!isset($_SESSION['listaKlubovi']))
              $_SESSION['listaKlubovi'] = array();
            $_SESSION['listaKlubovi'][] = $klub;
            header('Location:../view-gosti/favoriteClubsList.php');
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
