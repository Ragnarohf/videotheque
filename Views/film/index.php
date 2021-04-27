<?php

require_once("../../Autoloader.php");

use App\Autoloader;
use App\Controllers\FilmController;

Autoloader::register();

include("../header.php");
$filmController = new FilmController;
$listFilm = $filmController->list("title", 0, 20);

?>
<section class="d-flex justify-content-between flex-wrap container">
    <?php
    for ($i = 0; $i < count($listFilm); $i++) { ?>


        <div class="card my-2" style="width: 14rem;">
            <?php if (file_exists("../../public/assets/img/posters/" . $listFilm[$i]->id . ".jpg")) { ?>
                <img class="card-img-top" src="../../public/assets/img/posters/<?= $listFilm[$i]->id ?>.jpg" alt="Card image cap">
            <?php } else { ?>
                <img class="card-img-top" src="https://picsum.photos/220/330" alt="Card image cap">
            <?php } ?>

            <div class="card-body">
                <h5 class="card-title"><?= $listFilm[$i]->title ?></h5>
                <p class="card-text"><?= $listFilm[$i]->directors ?> - <?= $listFilm[$i]->year ?></p>
                <p class="card-text"><?= $listFilm[$i]->genres ?></p>
                <p class="card-text"><?= $listFilm[$i]->cast ?></p>
                <p class="card-text"><?= substr($listFilm[$i]->plot, 0, 100) . "..." ?></p>
                <a href="#" class="btn btn-primary">Voir le film</a>
            </div>
        </div>
    <?php } ?>
</section>