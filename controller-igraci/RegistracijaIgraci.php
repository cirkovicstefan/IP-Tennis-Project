<?php
require_once './RegistracijaIgraciController.php';
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'insert':
        $ic = new ControllerIgraci();
        $ic->InsertIgrac();
        break;
    
}
