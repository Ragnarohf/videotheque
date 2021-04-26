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
    <form class="formulaire" action="add.php" method="post" enctype="mutipart/form-data">
        <input type="text" name="name" id="name" placeholder="Nom" value="" />
        <div class="inputError"></div>
        <input type="email" name="email" id="email" placeholder="Email" value="" />
        <div class="inputError"></div>
        <!-- 
            Bonus show hide password jQuery :(
            https://codepen.io/Sohail05/pen/yOpeBm 
        -->
        <input type="text" name="pwd" id="pwd" placeholder="Mot de Passe" value="" />
        <div class="inputError"></div>
        <input type="text" name="pwd2" id="pwd2" placeholder="Confirmer le mot de passe" value="" />
        <div class="inputError"></div>
        <label for="avatar">Choissisez Votre Avatar</label>
        <input type="file" name="avatar" id="avatar" />
        <div class="inputError"></div>
        <input type="checkbox" name="rgpd" id="rgpd" />
        <label for="rgdp">En cliquant sur case vous acceptez les CGU.</label>

        <div class="inputError"></div>
        <input type="submit" value="Envoyer" />
    </form>
</div>
<?php
include("../footer.php");
?>