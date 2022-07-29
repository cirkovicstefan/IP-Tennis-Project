<?php
require_once './partials/navigacija.php';

require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

$korisnikDAO = new KorisnikDAO();
if (!isset($_SESSION)) {
  session_start();
}
$igraci = $_SESSION['lista'];
?>
<div class="container" style="background-image: url(./images/image-tenis.jpg); background-repeat: no-repeat; overflow:scroll; background-size: cover">
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
    <div class="container m-3" style="width: 90%;background-color: white; padding: 2rem; border: 1px solid red; border-radius:10px">

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
          <?php for ($i = 0; $i < count($igraci); $i++) { ?>


            <tr>
              <td><?= $igraci[$i]['ime'] ?></td>
              <td><?= $igraci[$i]['prezime'] ?></td>
              <td><?= $igraci[$i]['visina'] ?></td>
              <td><?= $igraci[$i]['godine'] ?></td>
              <td><?= $igraci[$i]['pobeda'] ?></td>
              <td><?= $igraci[$i]['porazi'] ?></td>
              <td><?= $igraci[$i]['email'] ?></td>

            </tr>
          <?php } ?>
        </tbody>
      </table>
      <?=$msg?>
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