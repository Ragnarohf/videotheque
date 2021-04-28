<?php

namespace App\Models;

use PDO;
use App\Models\Db;


class CommentModel extends Model
{

    protected $table = "comment";
    protected $link = "user_comment";

    public function newComment(array $post, int $id_film, int $id_user)
    {

        $this->db = Db::getInstance(); //$pdo
        $requete = $this->db->prepare("INSERT INTO $this->table (title,text,created_at) VALUES (:title,:text,NOW())");
        $requete->bindValue(":title", $post['title'], PDO::PARAM_STR);
        $requete->bindValue(":text", $post['text'], PDO::PARAM_STR);
        $requete->execute();
        $comment = new CommentModel;
        $tbComment = $comment->findAll("ORDER BY id_comment");
        $lastId = count($tbComment);
        $this->db = Db::getInstance(); //$pdo
        $requete = $this->db->prepare("INSERT INTO $this->link (id_user,id_comment,id) VALUES (:id_user,:id_comment,:id)");
        $requete->bindValue(":id_user", intval($id_user), PDO::PARAM_INT);
        $requete->bindValue(":id_comment", intval($lastId), PDO::PARAM_INT);
        $requete->bindValue(":id", intval($id_film), PDO::PARAM_INT);

        $requete->execute();
    }
}
