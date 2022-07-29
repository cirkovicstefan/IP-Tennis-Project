<?php
require_once './partials/navigacija.php';

require_once '../DAO/TerenDAO.php';
require_once '../model/Korisnik.php';
session_start();
$vremeActivneSesije = isset($_SESSION['last_active']) ? $_SESSION['last_active'] : 0;
if (time() - $vremeActivneSesije <  10*60) {
    if (!isset($_SESSION['loginKorisnik'])) {
        header("Location:./loginIgraci.php");
    } else {
        $tereni = new TerenDAO();
        $tereni = $tereni->getAllTereniKluboviJOIN();
?>


        <div class="container">
            <!--<a class="btn btn-primary col-sm-3 mt-5 mx-2 float-right" href="formaInserttereni.php">Dodaj teren</a>-->
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
                                <th class="th-sm">Naziv</th>
                                <th class="th-sm">Lokacija</th>
                                <th class="th-sm">Vrsta podloge</th>
                                <th class="th-sm">Kapacitet</th>
                                <th class="th-sm">Zauzet</th>
                                <th class="th-sm">Klub</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach ($tereni as $item) : ?>
                                <tr>
                                    <td><?= $item['naziv'] ?></td>
                                    <td><?= $item['lokacija'] ?></td>
                                    <td><?= $item['vrsta_podloge'] ?></td>
                                    <td><?= $item['kapacitet'] ?></td>
                                    <td><?php echo $item['zauzet'] == true ? ' <button class="btn btn-sm btn-outline-danger px-3">Zauzet</button>' : '<button class="btn btn-sm btn-outline-success">Slobodan</button>'; ?></td>
                                    <td><?= $item['naziv-kluba'] ?></td>
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
    header("Location: loginIgraci.php");
}

$_SESSION['last_active'] = time();    // update zadnje aktivnosti na sesiji
require_once './partials/podnozje.php';
?>