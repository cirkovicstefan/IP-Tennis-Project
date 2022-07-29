<?php
require_once './partials/navigacija.php';
?>
<?php
require_once '../model/Korisnik.php';
require_once '../DAO/TerenDAO.php';
require_once '../DAO/SportskiKlubDAO.php';
require_once '../model/Teren.php';
$tereni = new TerenDAO();
$tereni = $tereni->getAllTereniKluboviJOIN();
$sportskiDAO = new SportskiKlubDAO();
$klubovi = $sportskiDAO->getAllSportskiKlubovi();
session_start();
$sessija = isset($_SESSION['last_active']) ? $_SESSION['last_active']:0;
if (time() - $sessija <  10 * 60) {
    if (!isset($_SESSION['loginA'])) {
        header("Location:./loginadmin.php");
    } else {
?>
        <?php

        $korisnik_kluba = isset($_SESSION['kklub']) ? unserialize($_SESSION['kklub']) : new Korisnik();
        unset($_SESSION['kklub']);
        ?>

        <div class="container">
            <div class="row mt-4" style="width: 45%;margin-left:auto;margin-right:auto">
                <div class="col-md-12">
                    <form id="formIgrac" action="../controller-admin/KorisnikKluba.php?action=insert" method="post" class="border rounded p-5">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="ime" class="form-label">Ime <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="" name="ime" value="<?= $korisnik_kluba->getIme() ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="prezime" class="form-label">Prezime <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="" name="prezime" value="<?= $korisnik_kluba->getPrezime() ?>">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="" name="email" value="<?= $korisnik_kluba->getEmail() ?>">
                        </div>
                        <div class="mb-3">
                            <label for="lozinka" class="form-label">Lozinka <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="" name="lozinka" value="<?= $korisnik_kluba->getLozinka() ?>">
                        </div>
                        <div class="mb-3">
                            <label for="naziv_kluba" class="form-label">Naziv kluba <span class="text-danger">*</span></label>
                            <select name="naziv_kluba" class="form-control">
                                <?php foreach ($klubovi as $item) : ?>
                                <option value="<?= $item['naziv'] ?>"><?= $item['naziv']; ?></option>
                                <?php endforeach ?>
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
        <script src="./js/validacija-korisnikKluba.js"></script>
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