<?php
require_once './partials/navigacija.php';
require_once '../model/Korisnik.php';

?>

<div class="container" style="background-image: url('./images/image-tenis.jpg'); background-repeat: no-repeat; background-size: cover">
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
                $pozdrav = $pozdrav . '! Dobro došli!'
                ?>
                <h3 class="text-white py-3"><?= $pozdrav ?></h3>

            </div>

            <div class="col-md-6">
                <div class="dropdown py-3 position-fixed right-0 end-0 p-3 ">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">

                        <img src="./images/user128.png" width="32" class="rounded-circle me-2" height="32" alt="" srcset="">
                        <strong>Prijava</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">


                        <li><a class="dropdown-item" href="../view-klubovi/login.php">Klubovi</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../view-igraci/loginIgraci.php">Igraci</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../view-admin/loginadmin.php">Admin</a></li>
                    </ul>
                </div>
            </div>


        </div>


    </div>
    <div class="row">

    </div>

</div>


<?php

require_once './partials/podnozije.php';

?>