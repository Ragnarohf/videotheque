<?php

namespace App\Models;

use PDO;
use App\Models\Model;

class UserModel extends Model
{
    private $_id_user; // obligatoire
    private $_name; // obligatoire
    private $_email; // obligatoire
    private $_pwd; // obligatoire
    private $_pwd2; // obligatoire
    private $_avatar;
    private $_role;
    private $_created_at;
    protected $table = 'user';

    public function insert(array $attributs)
    {
        $this->db = Db::getInstance(); //$pdo

        $requete = $this->db->prepare("INSERT INTO $this->table (name,email,pwd,role,created_at) VALUES (:name, :email, :pwd, :role, :created_at)");
        $requete->bindValue(":name", $attributs['name'], PDO::PARAM_STR);
        $requete->bindValue(":email", $attributs['email'], PDO::PARAM_STR);
        $requete->bindValue(":pwd", $attributs['pwd'], PDO::PARAM_STR);
        $requete->bindValue(":role", $attributs['role'], PDO::PARAM_STR);
        $requete->bindValue(":created_at", $attributs['created_at'], PDO::PARAM_STR);


        $requete->execute();
        // me permet de récuperer le dernier id enregistré

        // 
    }
}
