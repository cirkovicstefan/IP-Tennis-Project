<?php
require_once './partials/navigacija.php';
require_once '../model/Korisnik.php';
session_start();

if (time() - $_SESSION['last_active'] <  10*60 ) {
if (!isset($_SESSION['loginKorisnik'])) {
    header("Location:./loginIgraci.php");
} else {
    $korisnik = isset($_SESSION['loginKorisnik']) ? unserialize($_SESSION['loginKorisnik']) : new Korisnik();
?>

<div class="container" style="background-image: url('./images/image-tenis.jpg'); background-repeat:no-repeat; background-size:cover; background-position:center;">
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
                    }else{
                        $pozdrav = 'Dobro došli';
                    }
                    $pozdrav = $pozdrav . ', dobro došli!' 
                    ?>
                    <h3 class="text-white py-3"><?= $pozdrav ?></h3>
                </div>

                    <!--ODJAVA IZ SESIJE-->
                <div class="col-md-6">
                    <div class="dropdown py-3 position-fixed right-0 end-0 p-3 " style="border: 2px solid white">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                         
                        <!--OVAJ DEO PRAVI PROBLEM ZBOG LOGINA-->

                        
                            
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
                            <li><a class="dropdown-item" href="../controller-igraci/LoginIgraci.php?action=logoutIgraci">Logout</a></li>
                        </ul>
                    </div>
                </div>


                </div>

                
                   </div>
                </div>
        <div class="row" >

        </div>
               
    </div>


<?php
}
} else {
    session_unset();
    session_destroy();
    header("Location: loginIgraci.php");
}

$_SESSION['last_active'] = time();   

require_once './partials/podnozje.php';

?>