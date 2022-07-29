<?php
require_once 'LoginIgraciController.php';

$action = isset($_GET['action']) ? $_GET['action'] : " ";

switch ($action) {
    case 'loginIgraci':
        $c = new LoginIgraciController();
        $c->loginIgraci();
        break;
        
    case 'logoutIgraci':
        $c = new LoginIgraciController();
        $c->logoutIgraci();
        break;

}
?>
