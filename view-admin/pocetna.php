<?php
require_once './partials/navigacija.php';
require_once '../model/Korisnik.php';
session_start();
$sessija = isset($_SESSION['last_active']) ? $_SESSION['last_active']:0;

if (time() - $sessija <  10 * 60) {
    if (!isset($_SESSION['loginA'])) {
        header("Location:./loginadmin.php");
    } else {
        $korisnik = isset($_SESSION['loginA']) ? unserialize($_SESSION['loginA']) : new Korisnik();
?>

        <div class="container" style="background-color:#ffffff;">
            <div class="row" style="height: 68px; background-color:#212529;">

                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <div class="dropdown py-3 position-fixed right-0 end-0 p-3">
                            <button style="background-color: #212529; border-radius: 10px; border: 2px solid white; color:#ffffff; font-size: 20px;"><a class="dropdown-item" href="../controller-admin/Login.php?action=logout">Logout</a></button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false" style="padding: 1.4rem;">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./images/image1.jpg" class="d-block" alt="" style="margin:auto; width:1000px; height:600px">
                        </div>
                        <div class="carousel-item">
                            <img src="./images/image2.jpg" class="d-block" alt="" style="margin:auto; width:1000px; height:600px">
                        </div>
                        <div class="carousel-item">
                            <img src="./images/image5.jpg" class="d-block" alt="" style="margin:auto; width:1000px; height:600px">
                        </div>
                        <div class="carousel-item">
                            <img src="./images/image4.jpg" class="d-block" alt="" style="margin:auto; width:1000px; height:600px">
                        </div>
                        <div class="carousel-item">
                            <img src="./images/image3.jpg" class="d-block" alt="" style="margin:auto; width:1000px; height:600px">
                        </div>
                    </div>
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
                    </div>
                </div>
                <div style="text-align:center">
                    <span class="dot"></span> 
                    <span class="dot"></span> 
                    <span class="dot"></span> 
                    <span class="dot"></span> 
                    <span class="dot"></span> 
                </div>
            </div>

            <script>
                let slideIndex = 0;
                showSlides();

                function showSlides() {
                let i;
                let slides = document.getElementsByClassName("carousel-item");
                let dots = document.getElementsByClassName("dot");
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";  
                }
                slideIndex++;
                if (slideIndex > slides.length) {slideIndex = 1}    
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex-1].style.display = "block";  
                dots[slideIndex-1].className += " active";
                setTimeout(showSlides, 3000); // Promena slike svake tri sekunde
                }
            </script>


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