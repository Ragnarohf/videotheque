<?php
require_once("../../Autoloader.php");

use App\Autoloader;
use App\Controllers\UserController;

Autoloader::register();
include("../header.php");
$form = UserController::validator($_POST, $_FILES);
?>

<h1>Inscrivez-vous</h1>
<div id="formUser">
    <form class="formulaire" action="add.php" method="post" enctype="multipart/form-data">
        <input type="text" name="name" id="name" placeholder="Nom" value="<?= !empty($form[1]['name']) ?  $form[1]['name'] : Null ?>" />
        <div class="inputError text-danger"><?= !empty($form[0]['name']) ?  $form[0]['name'] : Null ?> </div>
        <input type="email" name="email" id="email" placeholder="Email" value="<?= !empty($form[1]['email']) ?  $form[1]['email'] : Null ?>" />
        <div class="inputError text-danger"><?= !empty($form[0]['email']) ?  $form[0]['email'] : Null ?> </div>
        <!-- 
            Bonus show hide password jQuery :(
            https://codepen.io/Sohail05/pen/yOpeBm 
        -->
        <input type="text" name="pwd" id="pwd" placeholder="Mot de Passe" value="" />
        <div class="inputError text-danger"><?= !empty($form[0]['pwd']) ?  $form[0]['pwd'] : Null ?> </div>
        <input type="text" name="pwd2" id="pwd2" placeholder="Confirmer le mot de passe" value="" />

        <label for="avatar">Choissisez Votre Avatar</label>
        <input type="file" name="avatar" id="avatar" />
        <div class="inputError text-danger"><?= !empty($form[0]['avatar']) ?  $form[0]['avatar'] : Null ?> </div>
        <input type="checkbox" name="rgpd" id="rgpd" />
        <label for="rgdp">En cliquant sur case vous acceptez les CGU.</label>
        <div class="inputError text-danger"><?= !empty($form[0]['rgpd']) ?  $form[0]['rgpd'] : Null ?> </div>
        <input type="submit" value="Envoyer" />
    </form>
</div>
<?php
include("../footer.php");
?>