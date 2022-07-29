<?php
require_once '../DAO/MecDAO.php';
require_once '../model/Mec.php';

class ControllerMecevi
{

    public function InsertMec()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tip_mec = isset($_POST['tip_meca']) ? $this->test_input($_POST['tip_meca']) : '';
            
            $mec = new Mec();
            $mec->setTip_meca($tip_mec);
            
            session_start();
            $_SESSION['mec'] = serialize($mec);
            if (!empty($tip_mec)) {
                if (is_string($tip_mec)) {
                    $mecDAO = new MecDAO();
                    $mec = new Mec();
                    $mec->setTip_meca($tip_mec);
                    $mecDAO ->InsertMec($mec);
                    header("Location:../view-admin/mec.php");
                } else {
                    $msg = 'Tip meča mora da bude string tipa';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-admin/formaInsertMecevi.php");
                }
            } else {
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-admin/formaInsertMecevi.php");
            }
        }
    }

    public function EditMec($id)
    {
        $mecDAO = new MecDAO();
        $mec = $mecDAO->getMeceviById($id);
        session_start();
        $_SESSION['mec1'] = ($mec);
        header("Location:../view-admin/formaUpdateMecevi.php");
    }

    public function UpdateMec()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tip_mec = isset($_POST['tip_meca']) ? $this->test_input($_POST['tip_meca']) : '';
            $id =  isset($_POST['id']) ? $this->test_input($_POST['id']) : "";
            
            
            session_start();
            $_SESSION['mec1'] = array();
            $_SESSION['mec1']['id'] = $id;
            $_SESSION['mec1']['tip_meca'] = $tip_mec;

            if (!empty($tip_mec)) {
                if (is_string($tip_mec)) {
                    $mecDAO = new MecDAO();
                    $mec = new Mec();
                    $mec->setTip_meca($tip_mec);
                    $mecDAO ->UpdateMec($id, $mec);
                    header("Location:../view-admin/mec.php");
                } else {
                    $msg = 'Tip meča mora da bude string tipa';
                    $_SESSION['msg'] = $msg;
                    header("Location:../view-admin/formaUpdateMecevi.php");
                }
            } else {
                $msg = 'Morate popuniti sva polja';
                $_SESSION['msg'] = $msg;
                header("Location:../view-admin/formaUpdateMecevi.php");
            }
        }
    }
    public function DeleteMec($id)
    {
        $mecDAO = new MecDAO();
        $res = $mecDAO->DeleteMec($id);
        $msg = $res;
        session_start();
        $_SESSION['msg'] = $msg;
        header("Location:../view-admin/mec.php");
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
