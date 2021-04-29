<?php

namespace App\Models;

use PDO;
use App\Models\Db;
use App\Models\UserModel;


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

        $requete = $this->db->prepare("INSERT INTO $this->link (id_user,id) VALUES (:id_user,:id)");
        $requete->bindValue(":id_user", intval($id_user), PDO::PARAM_INT);
        $requete->bindValue(":id", intval($id_film), PDO::PARAM_INT);
        $requete->execute();

        $tbComment = $comment->findAll("ORDER BY id_comment");
        // recup last array entry array_key_last ( array $array )
        $key = array_key_last($tbComment);
        $lastId =  $tbComment[$key]->id_comment;
        $requete = $this->db->prepare("UPDATE $this->link SET id_comment=$lastId WHERE id_user_comment = $lastId");
        $requete->execute();
    }
    public function displayComment($id_film)
    {
        $this->db = Db::getInstance();
        $requete = $this->db->prepare("
        SELECT c.title,u.id_user,u.name,c.text,c.created_at 
        FROM user_comment as uc
        INNER JOIN comment as c
        ON c.id_comment = uc.id_comment
        INNER JOIN user as u
        ON u.id_user = uc.id_user
        WHERE uc.id = :id_film");
        $requete->bindValue(":id_film", intval($id_film), PDO::PARAM_INT);
        $requete->execute();
        $result = $requete->fetchAll();
        return $result;
    }
    public function selectCommentsForAdmin()
    {
        $user = new UserModel;
        $this->db = Db::getInstance();
        /* [
            {film1,comments1,id_users,movies_full.title,comment.created_at},
            {film2,comments1,id_users,movies_full.title,comment.created_at},
            {film2,comments2,id_users,movies_full.title,comment.created_at}
        ] */
        $requete = $this->db->prepare("
        SELECT c.id_comment,c.title,c.text,c.created_at,m.title as mtitle,m.id,uc.id_user 
        FROM comment as c
        INNER JOIN user_comment as uc
        ON c.id_comment = uc.id_comment
        INNER JOIN movies_full as m
        ON m.id = uc.id
        ORDER BY m.title,c.created_at");
        $requete->execute();
        $result = $requete->fetchAll();
        for ($i = 0; $i < count($result); $i++) {
            $tbuser = $user->findby(['id_user' => $result[$i]->id_user]);
            $result[$i]->name =  $tbuser[0]->name;
        }
        return $result;
    }
    public function deleteUserComment($id)
    {
        $comment = new CommentModel;
        $comment->delete(['id_comment' => $id]);
        $this->db = Db::getInstance();
        $requete = $this->db->prepare("DELETE FROM $this->link WHERE id_comment = $id");
        $requete->execute();
    }
}
