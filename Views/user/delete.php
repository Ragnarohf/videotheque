<?php

use App\Controllers\UserController;

$userController = new UserController;
$userController->deleteUser($_GET['id']);
header('Location:admin');
