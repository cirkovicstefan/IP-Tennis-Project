<?php
require_once './partials/navigacija.php';
require_once '../model/Korisnik.php';
session_start();

if (time() - $_SESSION['last_active'] <  10 * 60) {
    if (!isset($_SESSION['loginKorisnik'])) {
        header("Location:./loginIgraci.php");
    } else {
        $korisnik = isset($_SESSION['loginKorisnik']) ? unserialize($_SESSION['loginKorisnik']) : new Korisnik();
?>
        <div class="container" style="background-color: #eee;">
            <section>
                <form action="../controller-igraci/ProfilController.php?action=edit" method="post" id="formProfil" enctype='multipart/form-data'>
                    <div class="container py-5">


                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <?php
                                        if (!isset($korisnik['profilna_slika']) || empty($korisnik['profilna_slika'])) {
                                        ?>
                                            <img src="./images/user128.png" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                        <?php
                                        } else {
                                            echo '<img style="width: 150px;" class="rounded-circle" src="data:image/png/image/jpeg;base64,' . base64_encode($korisnik['profilna_slika']) . '" />';
                                        }
                                        ?>
                                        <h5 class="my-3">
                                            <?php echo $korisnik['ime'] . ' ' . $korisnik['prezime'] ?>
                                        </h5>
                                        <p class="text-muted mb-1">Igrač</p>
                                        <input type="file" class="btn  form-control btn-sm" name="slika"
                                        
                                        
                                        />
                                        <p class="text-muted mb-4"></p>

                                    </div>
                                </div>
                                <div class=" mb-4 mb-lg-0">

                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Ime</p>
                                            </div>
                                            <div class="col-sm-9">

                                                <input type="text" class="form-control" name="ime" id="" value="<?php echo $korisnik['ime'] ?>">

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Prezime</p>
                                            </div>
                                            <div class="col-sm-9">

                                                <input type="text" class="form-control" name="prezime" id="" value="<?php echo $korisnik['prezime'] ?>">

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email" id="" value=" <?php echo $korisnik['email']; ?>">
                                                <input type="hidden" name="id" value="<?= isset($korisnik['id']) ? $korisnik['id'] : '' ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                        <input type="submit" value="Sačuvaj promene" class="btn btn-primary btn-md">
                                        <div>
                                  

                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <script src="./js/jquery-3.6.0.js"></script>
        <script src="./js/jquery.validate.min.js"></script>
        <script src="./js/validacija-profila.js">
            </script>

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