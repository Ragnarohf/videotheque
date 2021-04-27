<?php

require_once("../../Autoloader.php");

use App\Autoloader;
use App\Controllers\FilmController;

Autoloader::register();
include("../header.php");
$filmController = new FilmController;
$listeFilm = $filmController->list("title", 0, 20);
var_dump($listeFilm);
