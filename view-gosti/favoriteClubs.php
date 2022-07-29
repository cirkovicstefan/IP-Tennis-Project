<?php
require_once './partials/navigacija.php';
?>
<?php
require_once '../model/SportiskiKlub.php';
require_once '../DAO/SportskiKlubDAO.php';
session_start();

$klubDAO = new SportskiKlubDAO();
$klubovi = $klubDAO->getAllSportskiKlubovi();
?>
<?php
$igrac = isset($_SESSION['klub']) ? unserialize($_SESSION['klub']) : new SportiskiKlub();
unset($_SESSION['igrac']);
?>
<div class="container" style="display: flex; flex-direction: row;background-image: url('./images/image-tenis.jpg'); background-repeat: no-repeat; background-size: cover;">
    <div class="row mt-4" style="width: 45%;margin-left:auto;margin-right:auto">
        <div class="col-md-12">
            <form id="formIgrac" action="../controller-gosti/OmiljeniKluboviController.php?action=sacuvaj" method="post" class="border rounded p-5" style="background-color:white;">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="naziv" class="form-label">Naziv <span class="text-danger">*</span></label>
                            <select name="naziv" class="form-control">
                                <?php foreach ($klubovi as $item) : ?>
                                    <option value="<?= $item['naziv'] ?>"><?= $item['naziv'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

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
<?php
require_once './partials/podnozije.php';
?>