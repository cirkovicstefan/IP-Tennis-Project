<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klubovi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/error-validacija.css">

</head>

<body>
    <?php

    session_start();
    $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
      session_destroy();
    // var_dump($_COOKIE);
    $korisnicko_ime = isset($_COOKIE['korisnicko_ime']) ? unserialize($_COOKIE['korisnicko_ime']) : null;
  //  print_r($korisnicko_ime);
    ?>

    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100" style="background-color: #eee;">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5   ">

                            <h3 class="mb-5 text-center">PRIJAVITE SE</h3>

                            <form id="formLogin" action="../controller-klubovi/Login.php?action=login" method="post">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="typeEmailX-2">Email <span class="text-danger">*</span></label>
                                    <input type="text" id="korisnickoime" name="email" value="<?= $korisnicko_ime ?>" class="form-control form-control-lg" />

                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="">Lozinka <span class="text-danger">*</span></label>
                                    <input type="password" id="lozinka" name="lozinka" class="form-control form-control-lg" />

                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="zapanti_ime" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Zapamti korisničko ime</label>
                                </div>



                                <div class="text-center">
                                    <input class="btn btn-primary btn-lg btn-block px-4 mt-3" type="submit" value="Prijava" name="prijavi">
                                    <p class="text-danger py-2 mt-3" style="font-weight: 500;" id="greska"> <?= $msg ?></p>
                                </div>
                            </form>
                            <hr class="my-4">



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="./js/jquery-3.6.0.js"></script>
    <script src="./js/jquery.validate.min.js"></script>
    <script src="./js/validacija-login.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>