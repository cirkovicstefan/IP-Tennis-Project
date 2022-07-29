<?php
require_once './partials/navigacija.php';

require_once '../DAO/PregledRezultataDAO.php';
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';
session_start();
unset($_SESSION['rezultat1']);
unset($_SESSION['rezultat']);
$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;
if (time() - $vremeActivneSesije <  10 * 60) {

    if (!isset($_SESSION['loginK'])) {
        header("Location:./login.php");
    } else {


        $rezultati = new PregledRezultataDAO();
        $rezultati = $rezultati->getAllJOIN();
        $korisnikDAO = new KorisnikDAO();
       // print_r($rezultati);

?>


        <div class="container">
            <a class="btn btn-primary col-sm-3 mt-5 mx-2 float-right" href="formaInsertRezultati.php">Dodaj rezultat</a>
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

                    <table class="table table-sm table-bordered  text-center  table-striped  table-sm mt-3" cellspacing="0" style=" margin-left:auto;margin-right:auto;font-size: 15px;" id="dtBasicExample" >
                        <thead class="table-dark sticky-top bg-white">
                            <tr>
                                <th class="th-sm">Rezultat</th>
                                <th class="th-sm">Potvrda rezultata</th>
                                <th class="th-sm">Id rezervacije</th>
                                <th class="th-sm">Protivnik 1</th>
                                <th class="th-sm">Protivnik 2</th>
                                <th class="th-sm">Protivnik 3</th>
                                <th class="th-sm">Protivnik 4</th>
                                <th class="th-sm">Status meča</th>
                              
                                <th class="th-sm">Izbriši</th>
                                <th class="th-sm">Izmeni</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach ($rezultati as $item) : ?>
                                <tr>
                                    <td><?= $item['rezultat'] ?></td>
                                    <td><?php echo $item['potvrda_rezultata'] == 1 ? ' <button class="btn btn-sm btn-outline-success px-3">Potvrđen</button>' : '<button class="btn btn-sm btn-outline-danger">Nepotvrđen</button>'; ?></td>
                                    
                                    <td><?= $item['id_rezervacije'] ?></td>
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

                                    <td><?= $item['status_meca'] ?></td>

                                    <td><a class="btn btn-danger btn-sm" href="../controller-klubovi/controllerRezultat.php?action=Izbrisi&id=<?= $item['id'] ?>">IZBRIŠI</a></td>
                                    <td><a class="btn btn-primary btn-sm" href="../controller-klubovi/controllerRezultat.php?action=Izmeni&id=<?= $item['id'] ?>">IZMENI</a></td>

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