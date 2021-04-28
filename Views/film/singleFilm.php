<?php

use App\Controllers\FilmController;
use App\Router;

$public = Router::$public;
$view = Router::$view;
$sessionActive = Router::$sessionActive;
include($view . "header.php");
$film = [];
if (!empty($_GET['id'])) {
    $filmController = new FilmController;
    $film = $filmController->film($_GET['id']);
}


?>
<link rel="stylesheet" href="../public/assets/css/film.css">
<section id="content" class="container">
    <div class="box">
        <div class="border-right">
            <div class="border-left">
                <div class="inner">
                    <h3><?= $film[0]->title ?></h3>
                    <p><?= $film[0]->plot ?></p>
                    <div class="img-box1">
                        <?php if (file_exists("$public/assets/img/posters/" . $film[0]->id . ".jpg")) { ?>
                            <img src="/videotheque/public/assets/img/posters/<?= $film[0]->id ?>.jpg" class="card-img-top " alt="..." style="max-width: 220px;">
                        <?php } else { ?>
                            <img src="https://picsum.photos/220/330" class="card-img-top" alt="..." style="max-width: 220px;">
                        <?php } ?>

                    </div>
                    <p><?= $film[0]->genres ?> - <?= $film[0]->year ?></p>
                    <p>casting : <?php
                                    foreach ($film[0]->cast as $value) { ?>
                            <a href="filmListBy?key=cast&value=<?= $value ?>"><?= $value ?></a>
                        <?php } ?>
                    </p>
                    <p><?= $film[0]->directors ?></p>
                    <p id='rating'>
                        <?php for ($i = 0; $i < $film[0]->rating; $i++) { ?>
                            <span class="star"><img src="/videotheque/public/assets/img/star-solid.svg" style="max-width: 30px;"></span>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if ($sessionActive) {
    echo '<a href="newComment?id=' . $_GET['id'] . '">Ajouter un commentaire</a>';
} ?>
<?php include("randomFilm.php"); ?>

<?php
include($view . "footer.php");
