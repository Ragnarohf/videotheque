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

                        This website template can be delivered in two packages - with PSD source files included and
                        without them. If you need PSD source files, please go to the template download page at
                        TemplateMonster to leave the e-mail address that you want the template ZIP package to be
                        delivered to.
                    </div>
                    <p>This website template has several pages: <a href="index.html">Home</a>, <a href="about-us.html">About us</a>, <a href="articles.html">Articles</a> (with Article page),
                        <a href="contact-us.html">Contact us</a> (note that contact us form – doesn’t work), <a href="sitemap.html">Site Map</a>.
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