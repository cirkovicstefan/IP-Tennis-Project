<?php
require_once './partials/navigacija.php';
?>
<?php
require_once '../model/SportiskiKlub.php';
session_start();
$sessija = isset($_SESSION['last_active']) ? $_SESSION['last_active']:0;
if (time() - $sessija <  10 * 60) {

    if (!isset($_SESSION['loginA'])) {
        header("Location:./loginadmin.php");
    } else {
?>
        <?php

        $sportski_klubovi = isset($_SESSION['klub1']) ? ($_SESSION['klub1']) : array();
        unset($_SESSION['klub1']);
        //print_r($sportski_klubovi);
        ?>


        <div class="container">
            <div class="row mt-4" style="width: 45%;margin-left:auto;margin-right:auto">
                <div class="col-md-12">
                    <form id="formIgrac" action="../controller-admin/Klubovi.php?action=update" method="post" class="border rounded p-5">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="naziv" class="form-label">Naziv <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="" name="naziv" value="<?= isset($sportski_klubovi['naziv']) ? $sportski_klubovi['naziv'] : ''  ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="adresa" class="form-label">Adresa <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="" name="adresa" value="<?= isset($sportski_klubovi['adresa']) ? $sportski_klubovi['adresa'] : ''  ?>">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= isset($sportski_klubovi['id']) ? $sportski_klubovi['id'] : ''  ?>">



                        <button type="submit" class="btn btn-primary">Sačuvaj</button>
                        <?php
                        // session_start();
                        $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
                        unset($_SESSION['msg']);
                        ?>
                        <p class="text-danger"><?= $msg ?></p>
                    </form>
                </div>
            </div>

        </div>
        <script src="./js/jquery-3.6.0.js"></script>
        <script src="./js/jquery.validate.min.js"></script>
        <script src="./js/validacija-klubovi.js"></script>
<?php
    }
} else {
    // REDIREKCIJA NA POCETNU STRANU DA SE OBRISE I UNISTI SESIJA AKO JE ISTEKLA
    session_unset();
    session_destroy();
    header("Location: loginadmin.php");
}

$_SESSION['last_active'] = time();    // update zadnje aktivnosti na sesiji
require_once './partials/podnozje.php';
?>