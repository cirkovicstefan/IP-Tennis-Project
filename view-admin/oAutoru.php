<?php
require_once './partials/navigacija.php';
session_start();

$sessija = isset($_SESSION['last_active']) ? $_SESSION['last_active']:0;
if (time() - $sessija <  10 * 60) {
    if (!isset($_SESSION['loginA'])) {
        header("Location:./loginadmin.php");
    } else {
?>

<!--==========Icon===========-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<div class="container" style="background-color:#ffffff;">
    <div class="row text-center ">
        <div class="col-lg-12 mt-3">
            <div class="section-title">
                
                <h2>
                    <span>AUTORI</span>
                </h2>
            </div>
        </div>
    </div>

    <div class="row text-center mt-2">

        <!-- Team item -->
        <div class="col-xl-4 col-sm-4 mb-5">
            <div class="bg-color rounded shadow-sm py-5 px-4">
                <img src="imgAutori/autor1.png" alt="" width="210" class="img-fluid mb-3 shadow-sm" style="clip-path: polygon(17% 0, 82% 0, 100% 19%, 100% 83%, 82% 100%, 16% 100%, 0 82%, 0 16%);">
                <h5 class="mb-0 bg-color">Emilija Dinčev</h5>
                <span class="medium text-uppercase text-muted bg-color">21/2018</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="https://www.facebook.com/emilija.dincev" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.instagram.com/emilli.d/" class="social-link"><i class="fa fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.linkedin.com/in/emilija-dincev/" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>


        <!-- Team item -->
        <div class="col-xl-4 col-sm-4 mb-5">
            <div class="bg-color rounded shadow-sm py-5 px-4">
                <img src="imgAutori/autor2.png" alt="" width="230" class="img-fluid mb-3 shadow-sm" style="clip-path: polygon(17% 0, 82% 0, 100% 19%, 100% 83%, 82% 100%, 16% 100%, 0 82%, 0 16%);">
                <h5 class="mb-0 bg-color">Milos Dinčev</h5>
                <span class="medium text-uppercase text-muted bg-color">20/2018</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="https://www.facebook.com/milos.dincev" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.instagram.com/_missa998_/" class="social-link"><i class="fa fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.linkedin.com/in/milos-dincev/" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>

        <!-- Team item -->
        <div class="col-xl-4 col-sm-4 mb-5">
            <div class="bg-color rounded shadow-sm py-5 px-4">
                <img src="imgAutori/autor3.png" alt="" width="240" class="img-fluid mb-3 shadow-sm" style="clip-path: polygon(17% 0, 82% 0, 100% 19%, 100% 83%, 82% 100%, 16% 100%, 0 82%, 0 16%);">
                <h5 class="mb-0 bg-color">Tamara Planinčić</h5>
                <span class="medium text-uppercase text-muted bg-color">82/2018</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.instagram.com/tamaraplanincicc/" class="social-link"><i class="fa fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-12 text-center">
            <a target="_blank" href="#"> <button class="btn btn-primary " type="submit" style="width: 20%;">Dokumentacija</button> </a>
        </div>
    </div>

</div>



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