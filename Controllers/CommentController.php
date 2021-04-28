<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Controllers\userController;

class CommentController
{

    public static $erreur = [];
    /**
     * newComment
     *
     * @param  mixed $post
     * @param  mixed $id_film
     * @param  mixed $id_user
     * @return void
     */
    public static function newComment(array $post, int $id_film, int $id_user)
    {
        if (!empty($post) && isset($post)) {

            $comment = new CommentModel();
            //titre
            $post['title'] = UserController::verifInput('title', true);
            //text
            $post['text'] = UserController::verifInput('text', true);
            if (count(self::$erreur) === 0) {
                $comment->newComment($post, $id_film, $id_user);
                echo "YOUPI";
            }
        }
    }
}
