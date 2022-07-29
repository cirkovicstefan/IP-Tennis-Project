<?php
require_once './partials/navigacija.php';
require_once '../model/Korisnik.php';
session_start();
$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;
if (time() - $vremeActivneSesije <  10 * 60) {
    if (!isset($_SESSION['loginK'])) {
        header("Location:./login.php");
    } else {
        $korisnik = isset($_SESSION['loginK']) ? unserialize($_SESSION['loginK']) : new Korisnik();
?>

        <div class="container" style="background-image: url('./images/image-tenis.jpg');">
            <div class="row" style="height: 68px; background-color:#212529;">

                <div class="row">
                    <div class="col-md-6">
                        <?php

                        $sati =  date('H');
                        $pozdrav = '';
                        if ($sati >= 4 && $sati <= 9) {
                            $pozdrav = 'Dobro jutro';
                        } else if ($sati >= 10 && $sati <= 19) {
                            $pozdrav = 'Dobar dan';
                        } else if ($sati >= 20 && $sati <= 24) {
                            $pozdrav = 'Dobro veče';
                        } else {
                            $pozdrav = 'Dobro jutro';
                        }
                        $pozdrav = $pozdrav . ', ' . $korisnik['ime'];
                        ?>
                        <h3 class="text-white py-3"><?= $pozdrav ?></h3>

                    </div>
                    <div class="col-md-6">
                        <div class="dropdown py-3 position-fixed right-0 end-0 p-3 ">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">

                                <?php
                                if (isset($korisnik['profilna_slika']))
                                    echo '<img width="32" height="32" class="rounded-circle me-2" src="data:image/png/image/jpeg;base64,' . base64_encode($korisnik['profilna_slika']) . '" />';
                                else
                                    echo '<img src="./images/user128.png" width="32" class="rounded-circle me-2" height="32" alt="" srcset="">';
                                ?>

                                <strong><?php echo $korisnik['ime'] . ' ' . $korisnik['prezime'] ?></strong>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">


                                <li><a class="dropdown-item" href="profil.php">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../controller-klubovi/Login.php?action=logout">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row">

            </div>

        </div>


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