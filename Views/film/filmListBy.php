<?php

use App\Controllers\FilmController;
use App\Router;

$public = Router::$public;
$view = Router::$view;
include($view . "header.php");

$listFilm = [];
if (!empty($_GET['key'])) {
    $filmController = new FilmController;
    $listFilm = $filmController->filmListBy($_GET['key'], $_GET['value']);
}
?>
<section class="d-flex justify-content-between flex-wrap container">

    <?php for ($i = 0; $i < count($listFilm); $i++) { ?>
        <div class="card my-2" style="width: 14rem;">
            <?php if (file_exists("$public/assets/img/posters/" . $listFilm[$i]->id . ".jpg")) { ?>
                <img src="/videotheque/public/assets/img/posters/<?= $listFilm[$i]->id ?>.jpg" class="card-img-top" alt="...">
            <?php } else { ?>
                <img src="https://picsum.photos/220/330" class="card-img-top" alt="...">
            <?php } ?>
            <div class="card-body">
                <h5 class="card-title"><?= $listFilm[$i]->title ?></h5>
                <p class="card-text"><?= $listFilm[$i]->directors ?> - <?= $listFilm[$i]->year ?></p>
                <p class="card-text"><?= $listFilm[$i]->genres ?></p>
                <p class="card-text"><?= $listFilm[$i]->cast ?></p>
                <p class="card-text"><?= $listFilm[$i]->plot ?></p>
                <a href="film.php?id=<?= $listFilm[$i]->id ?>" class="btn btn-primary">Voir le Film</a>
            </div>
        </div>
    <?php } ?>
</section>
<section>
    <?php include("randomFilm.php"); ?>
</section>




<?php
include($view . "footer.php");
