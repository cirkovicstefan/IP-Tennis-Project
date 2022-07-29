<?php
require_once './partials/navigacija.php';

require_once '../DAO/OpremaDAO.php';
require_once '../model/Oprema.php';

$opremaDAO = new OpremaDAO();
$oprema = $opremaDAO->getAllOpremeTipOpremeJOIN()
?>

<div class="container" style="display: flex; flex-direction: row;background-image: url('./images/image-tenis.jpg'); background-repeat: no-repeat; background-size: cover; overflow:scroll;" >
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
        <?php foreach ($oprema as $item) { ?>
            <div class="card bg-dark py-3" style="width: 14rem; height: 26rem; margin: 0.5rem; color: white">
            <?php $image = "./images/" . $item['tipovi_opreme'] . ".jpg";?>
                <img style="height:150px; padding-top: 5px;" src="<?php echo $image; ?>"  class="card-img-top" alt="<?php echo $item['tipovi_opreme']?>"> 
                <div class="card-body">
                    <h5 class="card-title">Naziv: <?= $item['naziv'] ?></h5>
                 <h6 style="text-decoration: underline;" title="Slika iznad">Tip opreme: <?=$item['tipovi_opreme']?></h6>
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item">Opis: <?= $item['opis'] ?></li>
                    <li class="list-group-item">Tip opreme: <?= $item['tipovi_opreme'] ?></li>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>
<?php
require_once './partials/podnozije.php';
?>