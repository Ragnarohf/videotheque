<?php

use App\Controllers\CommentController;

$commentController = new CommentController;
$commentController->deleteComment($_GET['id']);
header('Location:admin');
