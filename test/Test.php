<?php 
require_once '../DAO/KorisnikDAO.php';

$korisnikDAO = new KorisnikDAO();

print_r($korisnikDAO->SetPobede(7));



?>
