<?php

use App\Controllers\UserController;
use App\Router;

$public = Router::$public;
$view = Router::$view;
include($view . "header.php");


$form = UserController::validator($_POST, $_FILES);

?>
<h1>Inscrivez-vous</h1>
<div id="formUser">
    <form class="formulaire" action="registration" method="post" enctype="multipart/form-data">
        <input type="text" name="name" id="name" placeholder="Nom" value="<?= !empty($form[1]['name']) ? $form[1]['name'] : NULL ?>">
        <div class="inputError text-danger"><?= !empty($form[0]['name']) ? $form[0]['name'] : NULL ?></div>
        <input type="email" name="email" id="email" placeholder="Email" value="<?= !empty($form[1]['email']) ? $form[1]['email'] : NULL ?>">
        <div class="inputError text-danger"><?= !empty($form[0]['email']) ? $form[0]['email'] : NULL ?></div>
        <!-- 
            Bonus show hide password jQuery :(
            https://codepen.io/Sohail05/pen/yOpeBm 
        -->
        <input type="text" name="pwd" id="pwd" placeholder="Mot de Pass" value="">
        <div class="inputError text-danger"><?= !empty($form[0]['pwd']) ? $form[0]['pwd'] : NULL ?></div>
        <input type="text text-danger" name="pwd2" id="pwd2" placeholder="Confirmer le mot de pass" value="">
        <input type="file" name="avatar" id="avatar">
        <div class="inputError text-danger"><?= !empty($form[0]['avatar']) ? $form[0]['avatar'] : NULL ?></div>
        <label for="rgpd">En cliquant sur cette case vous acceptez les cgu.</label>
        <input type="checkbox" name="rgpd" id="rgpd">
        <div class="inputError text-danger"><?= !empty($form[0]['rgpd']) ? $form[0]['rgpd'] : NULL ?></div>
        <input type="submit" value="Envoyer">
    </form>
</div>
<?php
include($view . "footer.php");
?>