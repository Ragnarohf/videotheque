<?php


use App\Controllers\FilmController;
use App\Router;

$public = Router::$public;
$view = Router::$view;
$sessionActive = Router::$sessionActive;
include($view . "header.php");
$limit = 20;
$offset = 0;
if (!empty($_GET['p']) && isset($_GET['p'])) {
    $offset = $_GET['p'] * $limit;
}
$filmController = new FilmController;
$retourController = $filmController->list("title", $offset, $limit);
$listFilm = $retourController[0];
$nbPage = $retourController[1];
?>
<section class="d-flex justify-content-between flex-wrap container">

    <?php for ($i = 0; $i < count($listFilm); $i++) { ?>
        <div class="card my-2" style="width: 14rem;">

            <?php
            if (file_exists($public . "/assets/img/posters/" . $listFilm[$i]->id . ".jpg")) {
            ?>
                <img src="/videotheque_poo/public/assets/img/posters/<?= $listFilm[$i]->id ?>.jpg" class="card-img-top" alt="...">
            <?php } else { ?>
                <img src="https://picsum.photos/220/330" class="card-img-top" alt="...">
            <?php } ?>
            <div class="card-body">
                <h5 class="card-title"><?= $listFilm[$i]->title ?></h5>
                <p class="card-text"><?= $listFilm[$i]->directors ?> - <?= $listFilm[$i]->year ?></p>
                <p class="card-text"><?= $listFilm[$i]->genres ?></p>
                <p class="card-text"><?= $listFilm[$i]->cast ?></p>
                <p class="card-text"><?= $listFilm[$i]->plot ?></p>
                <a href="singleFilm?id=<?= $listFilm[$i]->id ?>" class="btn btn-primary">Voir le Film</a>
            </div>
        </div>
    <?php } ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>

            <?php for ($i = 0; $i < $nbPage; $i++) { ?>
                <li class="page-item"><a class="page-link" href="home?p=<?= $i ?>"><?= $i + 1 ?></a></li>
            <?php } ?>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</section>