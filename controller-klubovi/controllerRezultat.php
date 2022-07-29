<?php
require_once './RezultatiController.php';
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'insert':
        $controller = new RezultatiController();
        $controller->InsertPregledRezultata();
        break;
    case 'Izbrisi':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        //echo $id;
        $controller = new RezultatiController();
        $controller->DeletePregledRezultata($id);
        break;
    case 'Izmeni':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        //print_r($id);
           $controller = new RezultatiController();
        $controller->EditRezultati($id);
        break;
    case 'update':
        $controller = new RezultatiController();
        $controller->UpdatePregledRezultata();
        break;
}
