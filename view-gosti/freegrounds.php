<?php
require_once './partials/navigacija.php';

require_once '../DAO/TerenDAO.php';
require_once '../model/Teren.php';

$terenDAO = new TerenDAO();
$tereni = $terenDAO->getAllTereni()
?>

<div class="container" style="display: flex; flex-direction: row;background-image: url('./images/image-tenis.jpg'); background-repeat: no-repeat; background-size: cover;">
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
        <?php foreach ($tereni as $item) { if($item['zauzet']==0) {?>
            <div class="card bg-dark" style="width: 18rem; height: 25rem; margin: 0.5rem; color: white">
            <?php $image = "./images/" . $item['vrsta_podloge'] . ".jpg";?>
                <img style="height:100px; padding-top: 5px;" src="<?php echo $image; ?>"  class="card-img-top" alt="teren">
                <div class="card-body">
                    <h5 class="card-title"><?= $item['naziv'] ?></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Lokacija: <?= $item['lokacija'] ?></li>
                    <li class="list-group-item">Vrsta podloge: <?= $item['vrsta_podloge'] ?></li>
                    <li class="list-group-item">Kapacitet: <?= $item['kapacitet'] ?></li>
                    <li class="list-group-item">Id kluba: <?= $item['id_kluba'] ?></li>
                </ul>
            </div>
        <?php }} ?>
    </div>
   <!-- <a href="grounds.php"><img src="./images/back.png" class="m-auto d-block" style="height: 30px;" alt=""></a> -->
</div>
<?php
require_once './partials/podnozije.php';
?>