<?php
session_start();
$sessionActive = false;
if (!empty($_SESSION['user'])) {
    $sessionActive = true;
}
require_once("../Autoloader.php");

use App\Autoloader;
use App\Router;

Autoloader::register();
Router::start($sessionActive);
