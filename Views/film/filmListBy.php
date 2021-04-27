<?php
require_once("../../Autoloader.php");

use App\Autoloader;

Autoloader::register();

use App\Controllers\FilmController;


include("../header.php");

$listFilm = [];
if (!empty($_GET['key'])) {
    $filmController = new FilmController;
    $listFilm = $filmController->filmListBy($_GET['key'], $_GET['value']);
    var_dump($listFilm);
}
