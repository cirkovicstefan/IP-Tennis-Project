<?php
require_once './partials/navigacija.php';

require_once '../DAO/SportskiKlubDAO.php';
require_once '../model/SportiskiKlub.php';

$klubDAO = new SportskiKlubDAO();
$klubovi = $klubDAO->getAllSportskiKlubovi();
?>

<div class="container">
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
                        
                        <th class="th-sm">Naziv</th>
                        <th class="th-sm">Adresa</th>
                    </tr>
                </thead>
                <tbody>


                    <?php foreach ($klubovi as $item) : ?>
                        <tr>
                            
                            <td><?= $item['naziv'] ?></td>
                            <td><?= $item['adresa'] ?></td>
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
  <div class="carousel-inner">
  
    <div class="carousel-item active">
    <h5 style="color: green;">Zvezda</h5>
      <img src="./images/k3.jpg" class="d-block w-100 h-50" alt="Zvezda">    
    </div>
    <div class="carousel-item">
    <h5 style="color: green;">Partizan</h5>
      <img src="./images/k4.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
    <h5 style="color: green;">Napredak</h5>
      <img src="./images/k1.jpg" class="d-block w-100" alt="...">
     
    </div>
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
        require_once './partials/podnozje.php';
        ?>