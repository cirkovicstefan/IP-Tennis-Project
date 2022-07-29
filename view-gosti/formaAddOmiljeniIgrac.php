<?php
require_once './partials/navigacija.php';
?>
<?php
require_once '../model/Korisnik.php';
require_once '../DAO/KorisnikDAO.php';
session_start();

$korisnikDAO = new KorisnikDAO();
$igraci = $korisnikDAO->getAllIgraci();
?>
        <?php
        $igrac = isset($_SESSION['igrac']) ? unserialize($_SESSION['igrac']) : new Korisnik();
        unset($_SESSION['igrac']);
        ?>
        <div class="container" style="display: flex; flex-direction: row;background-image: url('./images/image-tenis.jpg'); background-repeat: no-repeat; background-size: cover;">
            <div class="row mt-4" style="width: 45%;margin-left:auto;margin-right:auto;">
                <div class="col-md-12">
                    <form id="formIgrac" action="../controller-gosti/OmiljeniIgraciController.php?action=sacuvaj" method="post" class="border rounded p-5" style="background-color:white;">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="ime" class="form-label">Ime <span class="text-danger">*</span></label>
                                    <select name="ime" class="form-control">
                                    <?php foreach ($igraci as $item) : ?>
                                        <option value="<?=$item['ime']?>"><?=$item['ime']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="prezime" class="form-label">Prezime <span class="text-danger">*</span></label>
                                    <select name="prezime" class="form-control">
                                    <?php foreach ($igraci as $item) : ?>
                                        <option value="<?=$item['prezime']?>"><?=$item['prezime']?></option>
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
        <script src="./js/validacija-igraci.js"></script>
<?php
//     }
// } else {
//     // REDIREKCIJA NA POCETNU STRANU DA SE OBRISE I UNISTI SESIJA AKO JE ISTEKLA
//     session_unset();
//     session_destroy();
//     header("Location: login.php");
// }

//$_SESSION['last_active'] = time();    // update zadnje aktivnosti na sesiji
require_once './partials/podnozije.php';
?>