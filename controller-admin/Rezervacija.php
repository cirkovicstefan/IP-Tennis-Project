<?php
require_once './RezervacijaController.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'insertDouble':
        $rc = new RezervacijaController();
        $rc->InsertRezervacijeDouble();
        break;
    case 'insertSingle':
        $rc = new RezervacijaController();
        $rc->InsertRezervacijeSingle();
        break;
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $id_terena = isset($_GET['id_terena']) ? $_GET['id_terena'] : '';
       // print_r($id_terena);
        $rc = new RezervacijaController();
        $rc->PonistiRezervaciju($id,$id_terena);

        break;
}
