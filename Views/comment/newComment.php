<?php
$mdp  = "biquette";
use App\Controllers\CommentController;
use App\Router;
$public = Router::$public;
$view = Router::$view;
$sessionActive = Router::$sessionActive;
use App\Controllers\FilmController;
$film = new FilmController;
$infosFilm = $film->film($_GET['id']);

include($view."header.php");

$form = CommentController::newComment($_POST,$_GET['id'],$_SESSION['user']->id_user);
?>
<h1>Ajouter un commentaire sur <?= $infosFilm[0]->title ?></h1>
<div id="formUser">
    <form class="formulaire" action="newComment?id=<?= $_GET['id'] ?>" method="post">
        <input type="text" name="title" id="title" placeholder="Titre du commenaire" value="<?= !empty($form[1]['title']) ? $form[1]['title'] : NULL ?>">
        <div class="inputError text-danger"><?= !empty($form[0]['title']) ? $form[0]['title'] : NULL ?></div>
        <!-- 
            Bonus show hide password jQuery :(
            https://codepen.io/Sohail05/pen/yOpeBm 
        -->
        <textarea name="text" id="text" placeholder="Votre Commentaire ..."><?= !empty($form[1]['text']) ? $form[1]['text'] : NULL ?></textarea>
        <div class="inputError text-danger"><?= !empty($form[0]['text']) ? $form[0]['text'] : NULL ?></div>
        
        <input type="submit" value="Envoyer">
    </form>
</div>
<?php
include($view."footer.php");
?>