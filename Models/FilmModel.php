<?php
namespace App\Models;
use PDO;
use App\Models\Model;

class FilmModel extends Model{

    protected $table = "movies_full";
    
    public function selectList($order,$offset,$limit){
        
        $this->db = Db::getInstance();
        $requete = $this->db->prepare("SELECT id,title,year,plot,genres,directors,cast FROM $this->table ORDER BY $order LIMIT $offset , $limit");
        $requete->execute();
        $result = $requete->fetchAll();
        return $result;
    }

    public function randomFilm($num){
        $this->db = Db::getInstance();
        $requete = $this->db->prepare("SELECT id,title,year,plot,genres,directors,cast FROM $this->table ORDER BY RAND() LIMIT 0 , $num");
        $requete->execute();
        $result = $requete->fetchAll();
        return $result;
    }
    public function filmListBy($key,$value){
        $this->db = Db::getInstance();
        $requete = $this->db->prepare("SELECT id,title,year,plot,genres,directors,cast FROM $this->table WHERE $key LIKE :value");
        $requete->bindValue(":value","%".$value."%",PDO::PARAM_STR);
        $requete->execute();
        $result = $requete->fetchAll();
        return $result;
    }

}