<?php
require_once './ControllerKorisnikKluba.php';
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'insert':
        $ic = new ControllerKorisnikKluba();
        $ic->InsertKorisnikKluba();
        break;
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        //print_r($id);
        $ic = new ControllerKorisnikKluba();
        $ic->DeleteKorisnikKluba($id);
        break;
    case 'edit':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        print_r($id);
        $ic = new ControllerKorisnikKluba();
        $ic->EditKorisnikKluba($id);
        break;
    case 'update':
        
        $ic = new ControllerKorisnikKluba();
        $ic->UpdateKorisnikKluba();
        break;
}
