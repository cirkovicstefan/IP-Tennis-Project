<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Igrači</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
   
    <link rel="stylesheet" href="./css/validacijaLogin.css">
</head>
<body>
    <?php
    session_start();
    $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
    session_destroy();
    ?>
        <div class="container  py-5 ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-6 ">
                    <div class="card shadow-2"  style="background:rgba(255,255,255,0.7)">
                        <div class="card-body p-5">
                            <h2 class="mb-2 text-center">PRIJAVA </h2>
                             <br>
                             <form id="formaLog" action="../controller-igraci/LoginIgraci.php?action=loginIgraci" method="post">
                             <div class="forma-element mb-2">
                            <h4> <label class="forma-label" for="typeEmailX-2">EMAIL:<span> *</span></label></h4> 
                              <input type="text" name="email" id="korisnickoime" required  class="form-control form-control-md"/>
                             </div>

                            <div class="forma-element mb-2">
                            <h4 > <label class="forma-label" for="">LOZINKA:<span> *</span></label></h4>
                             <input type="password" name="lozinka"  id="lozinka" class="form-control form-control-md" />
                             </div>
                             <input class="btn btn-warning btn-block" type="submit" value="Prijava" name="Prijava">
                             <br>
                             <p id="greska"> <?= $msg ?></p>

                             <div style=" text-align:right;
    font-size:15px;
    color:orangered;
    font-weight:500; 
    padding-right:20px"> <p id="notaccount">Nemate nalog? <a href="../view-igraci/RegistracijaIgraci.php">Registrujte se</a> </p></div>
           
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  

<script src="./js/jquery-3.6.0.js"></script>
<script src="./js/jquery.validate.min.js"></script>

<script src="js/validacija-login.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>