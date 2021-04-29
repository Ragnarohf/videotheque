<?php

use App\Controllers\CommentController;

$commentController = new CommentController;
$commentController->valideComment($_GET['id']);
header('Location:admin');
