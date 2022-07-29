<?php
require_once './ControllerKlubovi.php';
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'insert':
        $controller = new ControllerKlubovi();
        $controller->InsertKlubovi();
        break;
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        echo $id;
        $controller = new ControllerKlubovi();
        $controller->DeleteKlubovi($id);
        break;
    case 'edit':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $controller = new ControllerKlubovi();
        $controller->EditKlub($id);
        break;
    case 'update':
        $controller = new ControllerKlubovi();
        $controller->UpdateKlub();
        break;
}
