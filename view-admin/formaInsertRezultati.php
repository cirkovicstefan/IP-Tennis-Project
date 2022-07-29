<?php
require_once './partials/navigacija.php';
require_once '../DAO/RezervacijeDAO.php';
require_once '../model/PregledRezultata.php';
require_once '../DAO/PregledRezultataDAO.php';
$rezultati = new PregledRezultataDAO();
$rezultati = $rezultati->getAllJOIN();

$rezervacije = new RezervacijeDAO();
$rezervacije = $rezervacije->getAllRezervacije();

session_start();
$rezultat = isset($_SESSION['rezultat']) ? unserialize($_SESSION['rezultat']) : new PregledRezultata();
unset($_SESSION['rezultat']);
$sessija = isset($_SESSION['last_active']) ? $_SESSION['last_active']:0;
if (time() - $sessija <  10 * 60) {

    if (!isset($_SESSION['loginA'])) {
        header("Location:./loginadmin.php");
    } else {
?>


        <div class="container">
            <div class="row mt-4" style="width: 45%;margin-left:auto;margin-right:auto">
                <div class="col-md-12">
                    <form id="formRezultat" action="../controller-admin/Rezultati.php?action=insert" method="post" class="border rounded p-5">

                        <div class="mb-3">
                            <label for="rezultat" class="form-label">Rezultat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="" name="rezultat" placeholder="x-x" value="<?=$rezultat->getRezultat() ?>">
                        </div>

                        <div class="mb-3 form-check">
                            <label for="potvrda_rezultata" class="form-label"> Potvrda rezultata </label>
                            <input type="checkbox" class="form-check-input" id="" name="potvrda_rezultata" <?php  echo $rezultat->getPotvrda_rezultata() == 1 ? 'checked' : ''; 
                                                                                                            ?>>
                        </div>

                        <div class="mb-3">
                            <label for="id_rezervacije" class="form-label"> Rezervacija <span class="text-danger">*</span></label>
                            <select name="id_rezervacije" class="form-control">
                                <option value=""></option>
                                <?php foreach ($rezervacije as $item) : ?>
                                    <option value="<?= $item['id_r'] ?>"> <?php echo   'Id: ' . $item['id_r'] . ';   Datum:  ' . $item['datum'] . '; Vreme:' . $item['vreme'] . '; Teren:' . $item['naziv'] ?> </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status_meca" class="form-label"> Status meča <span class="text-danger">*</span></label>
                            <select name="status_meca" class="form-control">
                                <option value=""></option>
                                <option value="odigran">Odigran</option>
                                <option value="otkazan">Otkazan</option>
                            </select>
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
        <<script src="./js/validacija-rezultati.js"></script>


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