<?php
require_once './partials/navigacija.php';

require_once '../DAO/RezervacijeDAO.php';
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';
session_start();
$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;
if (time() - $vremeActivneSesije <  10*60 ) {
if (!isset($_SESSION['loginK'])) {
    header("Location:./login.php");
} else {
    $rezervacijeDAO = new RezervacijeDAO();
    $rezervacije = $rezervacijeDAO->getAllRezervacije();
    $korisnikDAO = new KorisnikDAO();
   // print_r($rezervacije);
?>


    <div class="container">
        <a class="btn btn-primary col-sm-3 mt-5 mx-2 float-right" href="formaInsertRezervacijaDouble.php">Rezerviši double</a>
        <a class="btn btn-primary col-sm-3 mt-5 mx-2 float-right" href="formaInsertRezervacijaSingle.php" >Rezerviši single</a>
        <div class="row">

            <?php

            $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
            if (!empty($msg)) {
            ?>
                <div class="toast show  position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                    <div class="toast-header ">
                        <strong class="me-auto"></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        <p><?= $msg ?></p>
                    </div>
                </div>
            <?php }
            unset($_SESSION['msg']);
            //session_destroy();
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

                                <td><a class="btn btn-danger btn-sm" href="../controller-klubovi/Rezervacija.php?action=delete&id=<?= $item['id_r'] ?>&id_terena=<?=$item['id_terena']?>">Poništi</a></td>
                                
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
    // REDIREKCIJA NA POCETNU STRANU DA SE OBRISE I UNISTI SESIJA AKO JE ISTEKLA
    session_unset();
    session_destroy();
    header("Location: login.php");
}

$_SESSION['last_active1'] = time();    // update zadnje aktivnosti na sesiji
    require_once './partials/podnozije.php';
        ?>