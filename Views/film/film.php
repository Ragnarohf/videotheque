<?php
require_once("../../Autoloader.php");

use App\Autoloader;

Autoloader::register();

use App\Controllers\FilmController;


include("../header.php");
$film = [];
if (!empty($_GET['id'])) {
    $filmController = new FilmController;
    $film = $filmController->film($_GET['id']);
}


?>
<link rel="stylesheet" href="../../public/assets/css/film.css">
<section id="content">
    <div class="box">
        <div class="border-right">
            <div class="border-left">
                <div class="inner">
                    <h3><?= $film[0]->title ?></h3>
                    <p><?= $film[0]->plot ?></p>
                    <div class="img-box1">
                        <?php if (file_exists("../../public/assets/img/posters/" . $film[0]->id . ".jpg")) { ?>
                            <img src="../../public/assets/img/posters/<?= $film[0]->id ?>.jpg" class="card-img-top" alt="...">
                        <?php } else { ?>
                            <img src="https://picsum.photos/220/330" class="card-img-top" alt="...">
                        <?php } ?>

                    </div>
                    <p><?= $film[0]->genres ?> - <?= $film[0]->year ?>
                    <p>casting : <?= $film[0]->cast ?>
                    <p><?= $film[0]->title ?>
                    </p>
                    <p id='rating'>
                        <?php for ($i = 0; $i < $film[0]->rating; $i++) { ?>
                            <span class="star"><img src="../../public/assets/img/star-solid.svg" style="max-width: 30px;"></span>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <?php include('randomFilm.php'); ?>
</section>
<?php
include("../footer.php")
?>