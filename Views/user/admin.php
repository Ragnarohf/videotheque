<?php

use App\Controllers\UserController;

use App\Router;
$public = Router::$public;
$view = Router::$view;
include($view."header.php");
$user = new UserController;
$listUser = $user->adminFindAll();
?>

<section id="users">
<table>
    <tr>
        <td>id_user</td>
        <td>name</td>
        <td>email</td>
        <td>role</td>
        <td>created_at</td>
        <td>
            <a href="deleteUser">Supprimer</a>
        </td>
    </tr>
    <?php for($i=0;$i<count($listUser);$i++){ ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>

    </tr>
    <?php } ?>
</table>
</section>