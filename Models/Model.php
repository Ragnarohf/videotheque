<?php

namespace App\Models;

use App\Models\Db;

class Model extends Db
{
    protected $table;
    protected $db;

    public function requete(string $sql, array $attributs = null)
    {
        //recupérer l'instance db 
        $this->db = Db::getInstance(); //$pdo
        if ($attributs !== null) {
            //requete prepared
            $requete = $this->db->prepare($sql);
            $requete->execute($attributs);
            return $requete;
        } else {
            return $this->db->query($sql);
        }
    }
    public function findAll($order = NULL)
    {
        $requete = $this->requete("SELECT * FROM $this->table " . $order);

        return $requete->fetchAll();
    }
    //tableau d'attributs
    //select * from livre where auther = x and titre = y
    //attributs = ['auteur'=>'x',"titre"=>'y']
    //select * from livre where auteur = x
    public function findby(array $attributs)
    {
        $tableauCle = [];

        foreach ($attributs as $key => $value) {
            $tableauCle[] = "$key = :$key";
            $value;
        }
        $meschamps = implode(' AND', $tableauCle);
        $requete = $this->requete("SELECT * from $this->table where $meschamps", $attributs);
        return $requete->fetchAll();
    }
    public function update(array $attributs, array $condition)
    {
        $tableauCle = [];
        $tabchampsCondition = [];
        foreach ($attributs as $key => $value) {
            $tableauCle[] = "$key = :$key";
            $value;
        }
        foreach ($condition as $key => $value) {
            $tabchampsCondition[] = "$key = :$key";
            $value;
        }
        $meschamps = implode(' AND', $tableauCle);
        $meschampsCondition = implode(' AND', $tabchampsCondition);
        $this->requete("UPDATE $this->table SET $meschamps where $meschampsCondition", array_merge($attributs, $condition));
    }
    public function delete($attributs)
    {
        $tableauCle = [];

        foreach ($attributs as $key => $value) {
            $tableauCle[] = "$key = :$key";
            $value;
        }
        $meschamps = implode(' AND', $tableauCle);
        $requete = $this->requete("DELETE  from $this->table where $meschamps", $attributs);
    }
}
