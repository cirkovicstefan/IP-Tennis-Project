<?php
require_once './partials/navigacija.php';

require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

$korisnikDAO = new KorisnikDAO();
$igraci = $korisnikDAO->getAllIgraci();
?>

<div class="container" style="overflow:scroll;">
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
                        <th class="th-sm">Ime</th>
                        <th class="th-sm">Prezime</th>
                        <th class="th-sm">Visina</th>
                        <th class="th-sm">Godine</th>
                        <th class="th-sm">Pobede</th>
                        <th class="th-sm">Porazi</th>
                        <th class="th-sm">Email</th>

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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="row">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="padding-left:25rem">
  <div class="carousel-inner">
    <div class="carousel-item active">
  <img src="./images/pN.png" class="d-block w-50" alt="player1">
    </div>
    <div class="carousel-item">
    <img src="./images/p2.jpg" class="d-block w-50" alt="player2">
    </div>
    <div class="carousel-item">
    <img src="./images/p4.png" class="d-block w-50" alt="player3">
    </div>
    <div class="carousel-item">
    <img src="./images/p3.png" class="d-block w-50" alt="player4">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
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
        require_once './partials/podnozije.php';
        ?>