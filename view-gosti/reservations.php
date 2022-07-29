<?php
require_once './partials/navigacija.php';

require_once '../DAO/RezervacijeDAO.php';
require_once '../model/Rezervacija.php';
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';
require_once '../DAO/TerenDAO.php';
require_once '../model/Teren.php';
require_once '../DAO/MecDAO.php';
require_once '../model/Mec.php';

$rezervacijaDAO = new RezervacijeDAO();
$rezervacije = $rezervacijaDAO->getAllRezervacije();
$korisnikDAO = new KorisnikDAO();
$terenDAO = new TerenDAO();
$tereni = $terenDAO->getAllTereni();
$meceviDAO = new MecDAO();
$mecevi = $meceviDAO->getAllMecevi();
?>

<div class="container" style="background-image: url(./images/image-tenis.jpg); overflow:scroll; background-repeat: no-repeat; background-size: cover">
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
        <div class="container m-3" style="width: 90%; background-color: white; padding: 2rem; border: 1px solid red; border-radius:10px">

            <table class="table table-bordered  text-center  table-striped  table-sm mt-3" cellspacing="0" style=" margin-left:auto;margin-right:auto" id="dtBasicExample">
                <thead class="table-dark sticky-top bg-white">
                    <tr>
                        <th class="th-sm">Id</th>
                        <th class="th-sm">Protivnik 1</th>
                        <th class="th-sm">Protivnik 2</th>
                        <th class="th-sm">Protivnik 3</th>
                        <th class="th-sm">Protivnik 4</th>
                        <th class="th-sm">Teren</th>
                        <th class="th-sm">Tip meca</th>
                        <th class="th-sm">Datum</th>
                        <th class="th-sm">Vreme</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($rezervacije as $item) : ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
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
                            <td>
                                <?php
                                $tereni = $terenDAO->getTereniById($item['id_terena']);
                                if ($tereni != null)
                                    echo $tereni['naziv'];
                                else
                                    echo '/';
                                ?>
                            </td>
                            <td> <?php
                                    $mecevi = $meceviDAO->getMeceviById($item['id_meca']);
                                    if ($mecevi != null)
                                        echo $mecevi['tip_meca'];
                                    else
                                        echo '/';
                                    ?> </td>
                            <td><?= $item['datum'] ?></td>
                            <td><?= $item['vreme'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
        require_once './partials/podnozije.php';
        ?>