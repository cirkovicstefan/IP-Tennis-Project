<?php
require_once './partials/navigacija.php';

require_once '../DAO/SportskiKlubDAO.php';
require_once '../model/SportiskiKlub.php';
session_start();

$sessija = isset($_SESSION['last_active']) ? $_SESSION['last_active'] : 0;
if (time() - $sessija <  10 * 60) {
    if (!isset($_SESSION['loginA'])) {
        header("Location:./loginadmin.php");
    } else {

        $sportski_klubDAO = new SportskiKlubDAO();
        $klubovi = $sportski_klubDAO->getAllSportskiKlubovi();


?>

        <div class="container" style="background-color:#ffffff;">
            <a class="btn btn-secondary mt-5 mx-2 float-right" href="formaInsertKlubovi.php">Dodaj sportski klub</a>
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

                    <table class="table table-bordered  text-center  table-striped  table-sm mt-3" cellspacing="0" style=" margin-left:auto; margin-right:auto" id="dtBasicExample">
                        <thead class="table-dark sticky-top bg-white">
                            <tr>
                                <th class="th-sm">Id</th>
                                <th class="th-sm">Naziv</th>
                                <th class="th-sm">Adresa</th>
                                <th class="th-sm">Obriši</th>
                                <th class="th-sm">Izmeni</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach ($klubovi as $item) : ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= $item['naziv'] ?></td>
                                    <td><?= $item['adresa'] ?></td>
                                    <td><a class="btn btn-danger btn-sm" href="../controller-admin/Klubovi.php?action=delete&id=<?= $item['id'] ?>">IZBRIŠI KLUB</a></td>
                                    <td><a class="btn btn-primary btn-sm" href="../controller-admin/Klubovi.php?action=edit&id=<?= $item['id'] ?>">IZMENI KLUB</a></td>
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