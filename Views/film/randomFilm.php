<?php
require_once("../../Autoloader.php");

use App\Autoloader;

Autoloader::register();

use App\Controllers\FilmController;

$filmController = new FilmController;
$randomFilm = $filmController->randomFilm(3);

?>
<h2 class="text-center">Notre IA a selectionné pour vous :</h2>
<section class="d-flex justify-content-between flex-wrap container">
    <?php
    for ($i = 0; $i < count($randomFilm); $i++) { ?>
        <div class="card my-2" style="width: 14rem;">
            <?php if (file_exists("../../public/assets/img/posters/" . $randomFilm[$i]->id . ".jpg")) { ?>
                <img class="card-img-top" src="../../public/assets/img/posters/<?= $randomFilm[$i]->id ?>.jpg" alt="Card image cap">
            <?php } else { ?>
                <img class="card-img-top" src="https://picsum.photos/220/330" alt="Card image cap">
            <?php } ?>
            <div class="card-body">
                <h5 class="card-title"><?= $randomFilm[$i]->title ?></h5>
                <p class="card-text"><?= $randomFilm[$i]->directors ?> - <?= $randomFilm[$i]->year ?></p>
                <p class="card-text"><?= $randomFilm[$i]->genres ?></p>
                <p class="card-text"><?= $randomFilm[$i]->cast ?></p>
                <p class="card-text"><?= substr($randomFilm[$i]->plot, 0, 100) . "..." ?></p>
                <a href="film.php?id=<?= $randomFilm[$i]->id ?>" class="btn btn-primary">Voir le film</a>
            </div>
        </div>
    <?php } ?>
</section>