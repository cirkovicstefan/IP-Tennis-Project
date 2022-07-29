<?php
require_once './partials/navigacija.php';

require_once '../DAO/TerenDAO.php';
require_once '../model/Teren.php';
require_once '../model/SportiskiKlub.php';
require_once '../DAO/SportskiKlubDAO.php';

$klubDAO = new SportskiKlubDAO();
$klubovi = $klubDAO->getAllSportskiKlubovi();
$br=0;
$terenDAO = new TerenDAO();
$tereni = $terenDAO->getAllTereni();
?>

<div class="container" style="display: flex; flex-direction: row;background-image: url('./images/image-tenis.jpg'); background-repeat: no-repeat; background-size: cover; overflow:scroll;">
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
        <?php foreach ($tereni as $item) { ?>
            <div class="card bg-dark py-2" style="width: 18rem; height: 25rem; margin: 0.5rem; color: white">
            <?php $image = "./images/" . $item['vrsta_podloge'] . ".jpg";?>
            <?php if($item['zauzet']==0) $br=$br+1?>
                <img style="height:100px; padding-top: 5px;" src="<?php echo $image; ?>"  class="card-img-top" alt="teren">
                <div class="card-body">
                    <h5 class="card-title"><?= $item['naziv'] ?></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Lokacija: <?= $item['lokacija'] ?></li>
                    <li class="list-group-item">Vrsta podloge: <?= $item['vrsta_podloge'] ?></li>
                    <li class="list-group-item">Kapacitet: <?= $item['kapacitet'] ?></li>
                    <li class="list-group-item">Klub:
                    <?php
                                    $klubovi = $klubDAO->getKluboviById($item['id_kluba']);
                                    if ($klubovi != null)
                                        echo $klubovi['naziv'] ;
                                    else
                                        echo '/';
                                    ?></li>

                    <?php if($item['zauzet']==0)$zauzet = 'slobodan';else $zauzet='zauzet'?>
                    <li class="list-group-item">Zauzetost: <?= $zauzet ?></li>
                </ul>
            </div>
        <?php } ?>
     
        <h3 style="color: white; text-decoration: underline">Broj trenutno slobodnih terena je <?=$br?></h3>
       <a href="freegrounds.php" style="color: white; text-decoration: underline">Prikaz slobodnih terena</a>
    </div>
   
</div>
<?php
require_once './partials/podnozije.php';
?>