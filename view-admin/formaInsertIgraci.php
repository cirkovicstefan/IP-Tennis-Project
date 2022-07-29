<?php
require_once './partials/navigacija.php';
?>
<?php
require_once '../model/Korisnik.php';
session_start();
$sessija = isset($_SESSION['last_active']) ? $_SESSION['last_active']:0;
if (time() - $sessija <  10 * 60) {
    if (!isset($_SESSION['loginA'])) {
        header("Location:./loginadmin.php");
    } else {
?>
        <?php

        $igrac = isset($_SESSION['igrac']) ? unserialize($_SESSION['igrac']) : new Korisnik();
        unset($_SESSION['igrac']);
        ?>


        <div class="container">
            <div class="row mt-4" style="width: 45%;margin-left:auto;margin-right:auto">
                <div class="col-md-12">
                    <form id="formIgrac" action="../controller-admin/Igraci.php?action=insert" method="post" class="border rounded p-5">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="ime" class="form-label">Ime <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="" name="ime" value="<?= $igrac->getIme() ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="prezime" class="form-label">Prezime <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="" name="prezime" value="<?= $igrac->getPrezime() ?>">
                                </div>
                            </div>

                        </div>


                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="pol" class="form-label">Pol <span class="text-danger">*</span></label>
                                    <select name="pol" class="form-control">
                                        <option value="muški">Muški</option>
                                        <option value="ženski">Ženski</option>
                                    </select>

                                </div>
                                <div class="col-md-4">
                                    <label for="visina" class="form-label">Visina <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="" name="visina" value="<?= $igrac->getVisina() ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="godine" class="form-label">Godine <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="" name="godine" value="<?= $igrac->getGodine() ?>">
                                </div>

                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="pobede" class="form-label">Pobede <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="" name="pobeda" value="<?= $igrac->getPobede() ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="porazi" class="form-label">Porazi <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="" name="porazi" value="<?= $igrac->getPorazi() ?>">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="" name="email" value="<?= $igrac->getEmail() ?>">
                        </div>
                        <div class="mb-3">
                            <label for="lozinka" class="form-label">Lozinka <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="" name="lozinka" value="<?= $igrac->getLozinka() ?>">
                        </div>



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
        <script src="./js/validacija-igraci.js"></script>
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