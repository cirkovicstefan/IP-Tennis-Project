<?php
require_once './ControllerMecevi.php';
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'insert':
        $controller = new ControllerMecevi();
        $controller->InsertMec();
        break;
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        echo $id;
        $controller = new ControllerMecevi();
        $controller->DeleteMec($id);
        break;
    case 'edit':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $controller = new ControllerMecevi();
        $controller->EditMec($id);
        break;
    case 'update':
        $controller = new ControllerMecevi();
        $controller->UpdateMec();
        break;
}
