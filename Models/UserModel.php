<?php

namespace App\Models;

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

    public function insert(array $attributs)
    {



        // $champs = [];
        // $valeurs = [];
        // foreach ($attributs as $key => $value) {
        //     array_push($champs, $key);
        //     array_push($valeurs, $key);
        // }
        // return $attributs;
        $requete = $this->requete(
            "INSERT into $this->table
         (name, email,pwd,role,created_at) VALUES 
         (:name,:email,:pwd,:role,:created_at)",
            $attributs['name'],
            $attributs['email'],
            $attributs['pwd'],
            $attributs['role'],
            $attributs['created_at']
        );
        //$last_id = $query->lastInsertId();
    }
}
