<?php
require_once './partials/navigacija.php';

require_once '../DAO/RezervacijeDAO.php';
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';
session_start();

$sessija = isset($_SESSION['last_active']) ? $_SESSION['last_active']:0;
if (time() - $sessija <  10 * 60) {
    if (!isset($_SESSION['loginA'])) {
        header("Location:./loginadmin.php");
    } else {
        $rezervacijeDAO = new RezervacijeDAO();
        $rezervacije = $rezervacijeDAO->getAllRezervacije();
        $korisnikDAO = new KorisnikDAO();
        // print_r($rezervacije);
?>

        <div class="container" style="background-color:#ffffff;">
            <a class="btn btn-secondary mt-5 mx-2 float-right" href="formaInsertRezervacijaDouble.php">Rezerviši double</a>
            <a class="btn btn-secondary mt-5 mx-2 float-right" href="formaInsertRezervacijaSingle.php">Rezerviši single</a>
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

                                    <td><a class="btn btn-danger btn-sm" href="../controller-admin/Rezervacija.php?action=delete&id=<?= $item['id_r'] ?>&id_terena=<?= $item['id_terena'] ?>">Poništi</a></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div>

                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false" style="padding: 1.4rem;">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>

            </div>
            <script>
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
    header("Location: loginadmin.php");
}

$_SESSION['last_active'] = time();    // update zadnje aktivnosti na sesiji
require_once './partials/podnozje.php';
    ?>