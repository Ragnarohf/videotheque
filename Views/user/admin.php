<?php

use App\Controllers\UserController;
use App\Controllers\CommentController;

use App\Router;

$public = Router::$public;
$view = Router::$view;
include($view . "header.php");
//user
$user = new UserController;
$listUser = $user->adminFindAll();
//comment
$comment = new CommentController;
$listComment = $comment->selectCommentsForAdmin();
//var_dump($listComment);
?>
<h1>Gestion Utilisateurs</h1>
<section id="users">
    <table class="w-100">
        <thead>
            <td>id_user</td>
            <td>name</td>
            <td>email</td>
            <td>role</td>
            <td>created_at</td>
            <td>
                Supprimer
            </td>
        </thead>
        <?php for ($i = 0; $i < count($listUser); $i++) { ?>
            <tr>
                <td><?= $listUser[$i]->id_user ?></td>
                <td><?= $listUser[$i]->name ?></td>
                <td><?= $listUser[$i]->email ?></td>
                <td><?= $listUser[$i]->role ?></td>
                <td><?= $listUser[$i]->created_at ?></td>
                <td><a href="deleteUser?id=<?= $listUser[$i]->id_user ?>">Supprimer</a></td>
            </tr>
        <?php } ?>
    </table>
</section>
<h1>Gestion Commentaires</h1>
<section id="comments">
    <table class="w-100">
        <thead>
            c.id_comment,c.title,c.text,c.created_at,m.title as mtitle,m.id,uc.id_user
            <td>id_comment</td>
            <td>mtitle</td>
            <td>title</td>
            <td>text</td>
            <td>name</td>
            <td>created_at</td>
            <td>Valider</td>
            <td>Supprimer</td>
        </thead>
        <?php for ($i = 0; $i < count($listComment); $i++) { ?>
            <tr>
                <td><?= $listComment[$i]->id_comment ?></td>
                <td><?= $listComment[$i]->mtitle ?></td>
                <td><?= $listComment[$i]->title ?></td>
                <td><?= $listComment[$i]->text ?></td>
                <td><?= $listComment[$i]->name ?></td>
                <td><?= $listComment[$i]->created_at ?></td>
                <td><a href="valideComment?id=<?= $listComment[$i]->id_comment ?>">Valider</a></td>
                <td><a href="deleteComment?id=<?= $listComment[$i]->id_comment ?>">Supprimer</a></td>
            </tr>
        <?php } ?>
    </table>
</section>