<?php
require_once './partials/navigacija.php';
?>
<?php
require_once '../DAO/TerenDAO.php';
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Teren.php';
require_once '../DAO/MecDAO.php';
$tereni = new TerenDAO();
$tereni = $tereni->getAllTereni();
$korinikDAO = new KorisnikDAO();
$igraci = $korinikDAO->getAllIgraci();
$mecDAO = new MecDAO();
$mecevi = $mecDAO->getAllMecevi();
session_start();
$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;
if (time() - $vremeActivneSesije <  10 * 60) {
    if (!isset($_SESSION['loginK'])) {
        header("Location:./login.php");
    } else {
        //print_r($igraci);
?>



        <div class="container">
            <?php

            $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
            if (!empty($msg)) {
            ?>
                <div class="toast show  position-fixed bottom-0 end-0 p-3 " style="z-index: 11; background-color: #ffd4dc;">
                    <div class="toast-header" style="background-color: #ffd4dc;"">
                    <strong class=" me-auto"></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        <p><?= $msg ?></p>
                    </div>
                </div>
            <?php }
            unset($_SESSION['msg']);
            //session_destroy();
            ?>
            <div class="row mt-4" style="width: 45%;margin-left:auto;margin-right:auto">
                <div class="col-md-12">
                    <form id="formRezervacija" action="../controller-klubovi/Rezervacija.php?action=insertDouble" method="post" class="border rounded p-5">
                        <div class="mb-3">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="id_igraca1" class="form-label">Protivnik1 <span class="text-danger">*</span></label>
                                    <select name="id_igraca1" class="form-control">
                                        <option value="" selected></option>
                                        <?php foreach ($igraci as $item) : ?>
                                            <option value="<?= $item['id'] ?>"><?php echo $item['ime'] . ' ' . $item['prezime'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="id_igraca2" class="form-label">Protivnik2 <span class="text-danger">*</span></label>
                                    <select name="id_igraca2" class="form-control">
                                        <option value="" selected></option>
                                        <?php foreach ($igraci as $item) : ?>
                                            <option value="<?= $item['id'] ?>"><?php echo $item['ime'] . ' ' . $item['prezime'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                        </div>


                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="id_igraca3" class="form-label">Protivnik3 <span class="text-danger">*</span></label>
                                    <select name="id_igraca3" class="form-control">
                                        <option value="" selected></option>
                                        <?php foreach ($igraci as $item) : ?>
                                            <option value="<?= $item['id'] ?>"><?php echo $item['ime'] . ' ' . $item['prezime'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="id_igraca4" class="form-label">Protivnik4 <span class="text-danger">*</span></label>
                                    <select name="id_igraca4" class="form-control">
                                        <option value="" selected></option>
                                        <?php foreach ($igraci as $item) : ?>

                                            <option value="<?= $item['id'] ?>"><?php echo $item['ime'] . ' ' . $item['prezime'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="id_terena" class="form-label">Teren <span class="text-danger">*</span></label>
                            <select name="id_terena" class="form-control">
                                <option value="" selected></option>
                                <?php foreach ($tereni as $item) : ?>
                                    <option value="<?= $item['id'] ?>"><?php echo $item['naziv'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_meca" class="form-label">Meč <span class="text-danger">*</span></label>
                            <select name="id_meca" class="form-control">
                                <option value="" selected></option>
                                <?php foreach ($mecevi as $item) : ?>
                                    <option value="<?= $item['id'] ?>"><?php echo $item['tip_meca'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="datum" class="form-label">Datum <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="datum" value="<?php echo date("Y-m-d") ?>">
                        </div>
                        <div class="mb-3">
                            <label for="vreme" class="form-label">Vreme <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" name="vreme">
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
        <script src="./js/validacija-rezervacija.js"></script>
<?php
    }
} else {
    // REDIREKCIJA NA POCETNU STRANU DA SE OBRISE I UNISTI SESIJA AKO JE ISTEKLA
    session_unset();
    session_destroy();
    header("Location: login.php");
}

$_SESSION['last_active1'] = time();    // update zadnje aktivnosti na sesiji
require_once './partials/podnozije.php';
?>