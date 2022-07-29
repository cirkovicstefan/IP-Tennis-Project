<?php
require_once './partials/navigacija.php';
session_start();
$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;
if (time() - $vremeActivneSesije <  10 * 60) {
    if (!isset($_SESSION['loginK'])) {
        header("Location:./login.php");
    } else {
        
?>


        <!--==========Icon===========-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



        <div class="container">
            <div class="row text-center ">
                <div class="col-lg-12 mt-3">
                    <div class="section-title">
                        <h2>
                            <span>Autori</span>
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row text-center mt-4">

                <!-- Team item -->
                <div class="col-xl-6 col-sm-6 mb-5">
                    <div class="bg-color rounded shadow-sm py-5 px-4"><img src="slike/profilna1.png" alt="" width="200" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                        <h5 class="mb-0 bg-color">Stefan Ćirković</h5><span class="small text-uppercase text-muted bg-color">27/2018</span>
                        <ul class="social mb-0 list-inline mt-3">
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>


                <!-- Team item -->
                <div class="col-xl-6 col-sm-6 mb-5">
                    <div class="bg-color rounded shadow-sm py-5 px-4"><img src="slike/profilna2.png" alt="" width="200" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                        <h5 class="mb-0 bg-color">Žarko Obradović</h5><span class="small text-uppercase text-muted bg-color">190/2018</span>
                        <ul class="social mb-0 list-inline mt-3">
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-12 text-center">
                    <a target="_blank" href=""> <button class="btn btn-primary " type="submit" style="width: 50%;">Dokumentacija</button> </a>
                </div>
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