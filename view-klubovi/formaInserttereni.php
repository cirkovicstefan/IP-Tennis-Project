<?php
require_once './partials/navigacija.php';
?>
<?php
require_once '../DAO/TerenDAO.php';
require_once '../DAO/SportskiKlubDAO.php';
require_once '../model/Teren.php';
$tereni = new TerenDAO();
$tereni = $tereni->getAllTereniKluboviJOIN();
$sportskiDAO = new SportskiKlubDAO();
$klubovi = $sportskiDAO->getAllSportskiKlubovi();
session_start();
$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;
if (time() - $vremeActivneSesije <  10*60) {

  if (!isset($_SESSION['loginK'])) {
    header("Location:./login.php");
  } else {
?>
    <?php

    $teren = isset($_SESSION['teren']) ? unserialize($_SESSION['teren']) : new Teren();
    unset($_SESSION['teren']);
    //print_r($teren);
    ?>


    <div class="container">
      <div class="row mt-4" style="width: 40%;margin-left:auto;margin-right:auto">
        <div class="col-md-12">
          <form id="formTeren" action="../controller-klubovi/controllerTeren.php?action=insert" method="post" class="border rounded p-5">
            <div class="mb-3">
              <label for="naziv" class="form-label">Naziv <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="" name="naziv" value="<?= $teren->getNaziv() ?>">

            </div>
            <div class="mb-3">
              <label for="lokacija" class="form-label">Lokacija <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="" name="lokacija" value="<?= $teren->getLokacija() ?>">
            </div>

            <div class="mb-3">
              <label for="kapacitet" class="form-label">Kapacitet <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="" name="kapacitet" value="<?= $teren->getKapacitet() ?>">
            </div>
            <div class="mb-3">
              <label for="vrsta_podloge" class="form-label">Vrsta podloge <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="" name="vrsta_podloge" value="<?= $teren->getVrstaPodloge() ?>">
            </div>
            <div class="mb-3 form-check">
              <label class="form-check-label" for="exampleCheck1">Zauzet</label>
              <input type="checkbox" class="form-check-input" id="exampleCheck1" name="zauzet" <?php echo $teren->getZauzet() == 1 ? 'checked' : ''; ?>>

            </div>

            <div class="mb-3">
              <label for="id_kluba" class="form-label">Klub <span class="text-danger">*</span></label>
              <select name="id_kluba" class="form-control">

                <?php foreach ($klubovi as $item) : ?>
                  <option value="<?= $item['id'] ?>"><?= $item['naziv']; ?></option>
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
    <script src="./js/validacija-teren.js"></script>
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