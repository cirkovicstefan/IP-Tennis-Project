<?php
require_once './partials/navigacija.php';
require_once '../DAO/RezervacijeDAO.php';
?>

<?php
require_once '../DAO/PregledRezultataDAO.php';
$rezultati = new PregledRezultataDAO();
$rezultati = $rezultati->getAllJOIN();

$rezervacijeDAO = new RezervacijeDAO();
$rezervacije = $rezervacijeDAO->getAllRezervacije();

session_start();
$rezultat = isset($_SESSION['rezultat1']) ? $_SESSION['rezultat1'] : array();
unset($_SESSION['rezultat1']);
$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;
//print_r($rezultat);
if (time() - $vremeActivneSesije <  10 * 60) {

    if (!isset($_SESSION['loginK'])) {
        header("Location:./login.php");
    } else {
?>


        <div class="container">
            <div class="row mt-4" style="width: 45%;margin-left:auto;margin-right:auto">
                <div class="col-md-12">
                    <form id="formRezultat" action="../controller-klubovi/controllerRezultat.php?action=update" method="post" class="border rounded p-5">

                        <div class="mb-3">
                            <label for="rezultat" class="form-label">Rezultat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="" name="rezultat" value="<?= isset($rezultat['rezultat']) ? $rezultat['rezultat'] : '' ?>">
                        </div>

                        <div class="mb-3 form-check">
                            <label for="potvrda_rezultata" class="form-label"> Potvrda rezultata </label>
                            <input type="checkbox" checked class="form-check-input" id="" name="potvrda_rezultata" <?php

                                                                                                                    if (!isset($rezultat['potvrda_rezultata'])) {
                                                                                                                        echo '';
                                                                                                                    } else {
                                                                                                                        if ($rezultat['potvrda_rezultata'] == 1) {
                                                                                                                            echo 'checked';
                                                                                                                        } else {
                                                                                                                            echo '';
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>>
                        </div>

                        <div class="mb-3">
                            <label for="id_rezervacije" class="form-label"> Rezervacija <span class="text-danger">*</span></label>
                            <select name="id_rezervacije" class="form-control">
                                <option value="<?= isset($rezultat['id_rezervacije']) ? $rezultat['id_rezervacije'] : "" ?>">
                                <?php
                                $rezervacijeById = $rezervacijeDAO->getRezervacijeById(isset($rezultat['id_rezervacije']) ? $rezultat['id_rezervacije'] : "" );

                                echo  isset($rezultat['id_rezervacije']) && isset($rezervacijeById) ? 'Id: ' . $rezultat['id_rezervacije'] . '   Datum:  ' . $rezervacijeById['datum'] . '   Vreme:  ' . $rezervacijeById['vreme'] : ''  ?>
                            </option>
                                <?php foreach ($rezervacije as $item) : ?>
                                    <option value=" <?= $item['id_r'] ?>"> <?php echo   'Id: ' . $item['id_r'] . '   Datum:  ' . $item['datum'] . '   Vreme:  ' . $item['vreme'] ?> </option>
                            <?php endforeach ?>
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="status_meca" class="form-label"> Status meča <span class="text-danger">*</span></label>
                            <select name="status_meca" class="form-control">
                                <option value="odigran">Odigran</option>
                                <option value="otkazan">Otkazan</option>
                            </select>

                        </div>

                        <input type="hidden" name="id" value="<?= isset($rezultat['id']) ? $rezultat['id'] : '' ?>">

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
        <script src="./js/validacija-rezultati.js"></script>

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