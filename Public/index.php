<?php
session_start();
require_once '../Autoloader.php';

use App\Autoloader;
use App\Router;

Autoloader::register();

Router::start();




?>
<a href="./zerzer/zerzer.php">zerzer</a>