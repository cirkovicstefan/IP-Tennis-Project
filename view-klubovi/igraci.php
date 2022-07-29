<?php
require_once './partials/navigacija.php';

require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';
session_start();
$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;
if (time() - $vremeActivneSesije <  10*60 ) {
    if (!isset($_SESSION['loginK'])) {
        header("Location:./login.php");
    } else {
        unset($_SESSION['igrac']);
        $korisnikDAO = new KorisnikDAO();
        $igraci = $korisnikDAO->getAllIgraci();
        // print_r($igraci);
?>


        <div class="container">
            <a class="btn btn-primary col-sm-3 mt-5 mx-2 float-right" href="formaInsertIgraci.php">Dodaj igrača</a>
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
                                <th class="th-sm">Ime</th>
                                <th class="th-sm">Prezime</th>
                                <th class="th-sm">Visina</th>
                                <th class="th-sm">Godine</th>
                                <th class="th-sm">Pobede</th>
                                <th class="th-sm">Porazi</th>
                                <th class="th-sm">Email</th>
                                <th class="th-sm">Obriši</th>
                                <th class="th-sm">Izmeni</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach ($igraci as $item) : ?>
                                <tr>
                                    <td><?= $item['ime'] ?></td>
                                    <td><?= $item['prezime'] ?></td>
                                    <td><?= $item['visina'] ?></td>
                                    <td><?= $item['godine'] ?></td>
                                    <td><?= $item['pobeda'] ?></td>
                                    <td><?= $item['porazi'] ?></td>
                                    <td><?= $item['email'] ?></td>
                                    <td><a class="btn btn-danger btn-sm" href="../controller-klubovi/Igraci.php?action=delete&id=<?= $item['id'] ?>">IZBRIŠI</a></td>
                                    <td><a class="btn btn-primary btn-sm" href="../controller-klubovi/Igraci.php?action=edit&id=<?= $item['id'] ?>">IZMENI</a></td>
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