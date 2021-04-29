<?php
namespace App\Models;
use PDO;
use App\Models\Db;


class CommentModel extends Model{

    protected $table = "comment";
    protected $link = "user_comment";

    public function newComment(array $post , int $id_film, int $id_user)
    {
        
        $this->db = Db::getInstance(); //$pdo
        $requete = $this->db->prepare("INSERT INTO $this->table (title,text,created_at) VALUES (:title,:text,NOW())");
        $requete->bindValue(":title",$post['title'],PDO::PARAM_STR);
        $requete->bindValue(":text",$post['text'],PDO::PARAM_STR);
        $requete->execute();
        $comment = new CommentModel;
        $tbComment = $comment->findAll("ORDER BY id_comment");
        $lastId = count($tbComment);
        $this->db = Db::getInstance(); //$pdo
        $requete = $this->db->prepare("INSERT INTO $this->link (id_user,id_comment,id) VALUES (:id_user,:id_comment,:id)");
        $requete->bindValue(":id_user",intval($id_user),PDO::PARAM_INT);
        $requete->bindValue(":id_comment",intval($lastId),PDO::PARAM_INT);
        $requete->bindValue(":id",intval($id_film),PDO::PARAM_INT);

        $requete->execute();

    }
    public function displayComment($id_film){
        $this->db = Db::getInstance();
        $requete = $this->db->prepare("
        SELECT c.title,u.id_user,u.name,c.text,c.created_at 
        FROM user_comment as uc
        INNER JOIN comment as c
        ON c.id_comment = uc.id_comment
        INNER JOIN user as u
        ON u.id_user = uc.id_user
        WHERE uc.id = :id_film"); 
        $requete->bindValue(":id_film",intval($id_film),PDO::PARAM_INT);
        $requete->execute();
        $result = $requete->fetchAll();
        return $result;
    }
}