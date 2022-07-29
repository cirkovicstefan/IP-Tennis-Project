<?php
require_once './partials/navigacija.php';

require_once '../DAO/SportskiKlubDAO.php';
require_once '../model/SportiskiKlub.php';

$klubDAO = new SportskiKlubDAO();
if (!isset($_SESSION)) {
  session_start();
}
$klubovi = $_SESSION['listaKlubovi'];
?>
<div class="container" style="background-image: url(./images/image-tenis.jpg); background-repeat: no-repeat; background-size: cover">
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
            <th class="th-sm">Id</th>
            <th class="th-sm">Naziv</th>
            <th class="th-sm">Adresa</th>
          </tr>
        </thead>
        <tbody>
          <?php for ($i = 0; $i < count($klubovi); $i++) { ?>


            <tr>
              <td><?= $klubovi[$i]['id']?></td>
              <td><?= $klubovi[$i]['naziv']?></td>
              <td><?= $klubovi[$i]['adresa']?></td>
            </tr>
          <?php } ?>
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