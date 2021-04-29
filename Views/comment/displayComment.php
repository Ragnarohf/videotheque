<?php

use App\Controllers\CommentController;

$displayComment = new CommentController;
$comments =  $displayComment->displayComment($_GET['id']);
$countComment = count($comments);
if ($countComment > 0) {
?>
    <section id="comments">
        <?php for ($i = 0; $i < count($comments) - 1; $i++) {  ?>
            <div>
                <h4><?= $comments[$i]->title ?></h4>
                <p><?= $comments[$i]->text ?></p>
                <p>Ecrit par <?= $comments[$i]->name ?> le <?= $comments[$i]->created_at ?></p>
            </div>
        <?php } ?>
    </section>
<?php }
