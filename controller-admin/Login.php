<?php
require_once 'ControllerLogin.php';
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'login':
        $cl = new ControllerLogin();
        $cl->Login();
        break;
    case 'logout':
        $cl = new ControllerLogin();
        $cl->Logout();
        break;

}
