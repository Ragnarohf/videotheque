<?php


use App\Controllers\FilmController;
use App\Router;

$public = Router::$public;
$view = Router::$view;
var_dump($public);
include($view . "header.php");


$filmController = new FilmController;
$listFilm = $filmController->list("title", 0, 20);
?>
<section class="d-flex justify-content-between flex-wrap container">

    <?php for ($i = 0; $i < count($listFilm); $i++) { ?>
        <div class="card my-2" style="width: 14rem;">
            <?php if (file_exists($public . "assets/img/posters/" . $listFilm[$i]->id . ".jpg")) { ?>
                <img src="./public/assets/img/posters/<?= $listFilm[$i]->id ?>.jpg" class="card-img-top" alt="...">
            <?php } else { ?>
                <img src="https://picsum.photos/220/330" class="card-img-top" alt="...">
            <?php } ?>
            <div class="card-body">
                <h5 class="card-title"><?= $listFilm[$i]->title ?></h5>
                <p class="card-text"><?= $listFilm[$i]->directors ?> - <?= $listFilm[$i]->year ?></p>
                <p class="card-text"><?= $listFilm[$i]->genres ?></p>
                <p class="card-text"><?= $listFilm[$i]->cast ?></p>
                <p class="card-text"><?= $listFilm[$i]->plot ?></p>
                <a href="./film/singleFilm.php?id=<?= $listFilm[$i]->id ?>" class="btn btn-primary">Voir le Film</a>
            </div>
        </div>
    <?php } ?>
</section>