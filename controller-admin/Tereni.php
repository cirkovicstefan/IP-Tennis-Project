<?php
require_once './ControllerTereni.php';
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'insert':
        $controller = new ControllerTereni();
        $controller->InsertTereni();
        break;
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        echo $id;
        $controller = new ControllerTereni();
        $controller->DeleteTereni($id);
        break;
    case 'edit':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $controller = new ControllerTereni();
        $controller->EditTeren($id);
        break;
    case 'update':
        $controller = new ControllerTereni();
        $controller->UpdateTeren();
        break;
}
