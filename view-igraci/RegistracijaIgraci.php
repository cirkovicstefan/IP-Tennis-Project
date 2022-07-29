<?php
require_once "../DAO/SportskiKlubDAO.php";
require_once '../model/Korisnik.php';
?>
<?php
session_start();
$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
unset($_SESSION['msg']);


$igrac = isset($_SESSION['igrac']) ? unserialize($_SESSION['igrac']) : new Korisnik();
unset($_SESSION['igrac']);
?>

<html>

<head>
  <link rel="stylesheet" href="../view-igraci/css/style.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap5.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap5.min.css">
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="./css/validacija_registracije.css">
  <script src="https://kit.fontawesome.com/55a51b56f8.js" crossorigin="anonymous"></script>
</head>

<body>
  <section class="vh-100 gradient-custom">
    <div class="container py-2 h-80">
      <div class="row justify-content-center align-items-center h-60" style="padding-top:10px">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="background:rgba(255,255,255,0.7)" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-4">
              <h3 style="text-align: center;"><i class="fa-solid fa-id-card"></i></h3>
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5" style="text-align: center;">REGISTRACIJA</h3>
              <form id="formaReg" action="../controller-igraci/RegistracijaIgraci.php?action=insert" method="post">

                <div class="row">
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" id="ime" name="ime" class="form-control form-control-lg" />
                      <label class="form-label" for="ime">Ime<span style="color:red">*</span></label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" id="prezime" name="prezime" class="form-control form-control-lg" />
                      <label class="form-label" for="prezime">Prezime<span style="color:red">*</span></label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3 d-flex align-items-center">

                    <div class="form-outline w-100">
                      <input type="text" name="visina" class="form-control form-control-lg" id="visina" />
                      <label for="visina" class="form-label">Visina<span style="color:red">*</span></label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-3 d-flex align-items-center">

                    <div class="form-outline  w-100">
                      <input type="text" name="godine" class="form-control form-control-lg" id="godine" />
                      <label for="godine" class="form-label">Godine<span style="color:red">*</span></label>
                    </div>

                  </div>

                  <div class="col-md-6 mb-4" style="padding-left:15px">

                    <h6 class="mb-2 pb-1">Pol<span style="color:red">*</span></h6>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="zenski" value="option1" checked />
                      <label class="form-check-label" for="zenski">Zenski</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="muski" value="option2" />
                      <label class="form-check-label" for="muski">Muski</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="someone@example.com" />
                      <label class="form-label" for="email">E-mail<span style="color:red">*</span></label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="password" name="lozinka" id="lozinka" class="form-control form-control-lg" />
                      <label class="form-label" for="lozinka">Lozinka<span style="color:red">*</span></label>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-12">

                      <select class="select form-control-lg" name="nazivkluba">
                        <option value="1" disabled>Izaberite opciju</option><?php
                                                                            $klub = new SportskiKlubDAO;
                                                                            $izbor = $klub->getAllSportskiKlubovi();

                                                                            foreach ($izbor as $a) {
                                                                            ?>
                          <option value="<?= $a["naziv"] ?>"> <?= $a["naziv"] ?></option>
                        <?php } ?>
                      </select>
                      <label class="form-label select-label">Naziv kluba<span style="color:red">*</span></label>

                    </div>

                  </div>
                  <div class="mt-4 pt-2 justify-content-center" style="text-align: center;">
                    <input class="btn btn-primary btn-lg" type="submit" name="action" value="Potvrdi" />
                  </div>
                  <p class="text-danger"><?= $msg ?></p>
                  <div style="text-align:right;font-size:16px;color:#000;font-weight:500; padding-right:20px"> <span>Imate nalog? <a href="../view-igraci/loginIgraci.php"><span> Prijavite se </span></a> </span></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./js/jquery-3.6.0.js"></script>
  <script src="../js/jquery.validate.min.js"></script>
  <script src="../js/validacija-registracija.js"></script>
  <script src="../js/validacija-drop.js"></script>
</body>

</html>