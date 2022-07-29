<?php
require_once './partials/navigacija.php';

require_once '../DAO/RezervacijeDAO.php';
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';
session_start();

if (time() - $_SESSION['last_active'] <  10*60 ) {
if (!isset($_SESSION['loginKorisnik'])) {
    header("Location:./loginIgraci.php");
} else {
    $rezervacijeDAO = new RezervacijeDAO();
    $rezervacije = $rezervacijeDAO->getAllRezervacije();
    $korisnikDAO = new KorisnikDAO();
    $korisnik = isset($_SESSION['loginKorisnik']) ? unserialize($_SESSION['loginKorisnik']) : new Korisnik();
   // print_r($_SESSION['loginKorisnik']);
?>


    <div class="container">
        <a class="btn btn-primary col-sm-3 mt-5 mx-2 float-right" href="formaInsertRezervacijaDouble.php">Rezerviši double</a>
        <a class="btn btn-primary col-sm-3 mt-5 mx-2 float-right" href="formaInsertRezervacijaSingle.php" >Rezerviši single</a>
        <div class="row">

            <?php

            $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
            if (!empty($message)) {
            ?>
                <div class="toast show  position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                    <div class="toast-header ">
                        <strong class="me-auto"></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        <p><?= $message ?></p>
                    </div>
                </div>
            <?php }
            unset($_SESSION['message']);
            ?>
            <div class="container m-3" style="width: 90%;">

                <table class="table table-bordered  text-center  table-striped  table-sm mt-3" cellspacing="0" style=" margin-left:auto;margin-right:auto" id="dtBasicExample">
                    <thead class="table-dark sticky-top bg-white">
                        <tr>
                            <th class="th-sm">Protivnik1</th>
                            <th class="th-sm">Protivnik2</th>
                            <th class="th-sm">Protivnik3</th>
                            <th class="th-sm">Protivnik4</th>
                            <th class="th-sm">Teren</th>
                            <th class="th-sm">Mec</th>
                            <th class="th-sm">Datum</th>
                            <th class="th-sm">Vreme</th>
                            <th class="th-sm">Poništi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($rezervacije as $item) : ?>

                           
                            <tr>
                                <td>
                                    <?php
                                    $igraci = $korisnikDAO->getAllIgraciById($item['id_igraca1']);
                                    if ($igraci != null)
                                        echo $igraci['ime'] . ' ' . $igraci['prezime'];
                                    else
                                        echo '/';
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $igraci = $korisnikDAO->getAllIgraciById($item['id_igraca2']);
                                    if ($igraci != null)
                                        echo $igraci['ime'] . ' ' . $igraci['prezime'];
                                    else
                                        echo '/';
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $igraci = $korisnikDAO->getAllIgraciById($item['id_igraca3']);
                                    if ($igraci != null)
                                        echo $igraci['ime'] . ' ' . $igraci['prezime'];
                                    else
                                        echo '/';
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $igraci = $korisnikDAO->getAllIgraciById($item['id_igraca4']);
                                    if ($igraci != null)
                                        echo $igraci['ime'] . ' ' . $igraci['prezime'];
                                    else
                                        echo '/';
                                    ?>
                                </td>
                                <td><?= $item['naziv'] ?></td>
                                <td><?= $item['tip_meca'] ?></td>
                                <td><?= $item['datum'] ?></td>
                                <td><?= $item['vreme'] ?></td>

                                <?php if($item['id_igraca1']==$korisnik['id']) {?>
                                <td><a class="btn btn-danger btn-sm" href="../controller-klubovi/Rezervacija.php?action=delete&id=<?= $item['id_r'] ?>&id_terena=<?=$item['id_terena']?>">Poništi</a></td>
                                <?php } else { ?>
                                    <td><a class="btn btn-danger btn-sm" href="../controller-klubovi/Rezervacija.php?action=delete&id=<?= $item['id_r'] ?>&id_terena=<?=$item['id_terena']?>">Da</a></td>
                                <?php }?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <script>
                // $('#sortTable').DataTable();
                $(document).ready(function() {
                    $('#dtBasicExample').DataTable();
                    $('.dataTables_length').addClass('bs-select');
                    $('.pagination').hide();
                    $('#dtBasicExample_info').hide();
                    $('#dtBasicExample_paginate').hide();
                    $('#dtBasicExample_length').hide();

                });
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