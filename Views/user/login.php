<?php

use App\Controllers\UserController;
use App\Router;
$public = Router::$public;
$view = Router::$view;
include($view."header.php");


$form = UserController::login($_POST);

?>
<h1>Connectez-vous</h1>
<div id="formUser">
    <form class="formulaire" action="login" method="post">
        <input type="email" name="email" id="email" placeholder="Email" value="<?= !empty($form[1]['email']) ? $form[1]['email'] : NULL ?>">
        <div class="inputError text-danger"><?= !empty($form[0]['email']) ? $form[0]['email'] : NULL ?></div>
        <!-- 
            Bonus show hide password jQuery :(
            https://codepen.io/Sohail05/pen/yOpeBm 
        -->
        <input type="text" name="pwd" id="pwd" placeholder="Mot de Pass" value="">
        <div class="inputError text-danger"><?= !empty($form[0]['pwd']) ? $form[0]['pwd'] : NULL ?></div>
        <input type="submit" value="Envoyer">
    </form>
</div>
<?php
include($view."footer.php");
?>