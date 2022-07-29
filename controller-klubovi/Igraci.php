<?php
require_once './IgraciController.php';
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'insert':
        $ic = new IgraciController();
        $ic->InsertIgrac();
        break;
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        //print_r($id);
        $ic = new IgraciController();
        $ic->DeleteIgrac($id);
        break;
    case 'edit':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        print_r($id);
        $ic = new IgraciController();
        $ic->EditIgrac($id);
        break;
    case 'update':
        
        $ic = new IgraciController();
        $ic->UpdateIgrac();
        break;
}
