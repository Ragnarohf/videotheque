<?php


namespace App\Models;

use PDO;
use App\Models\Model;

class FilmModel extends Model
{
    protected $table = 'movies_full';
    public function selectList($order, $offset, $limit)
    {
        $this->db = Db::getInstance(); //$pdo
        $requete = $this->db->prepare("SELECT id,title,year,plot,genres,directors,cast FROM $this->table ORDER BY $order LIMIT $offset,$limit");
        $requete->execute();
        return $requete->fetchAll();
    }
    public function randomFilm($num)
    {
        $this->db = Db::getInstance(); //$pdo
        $requete = $this->db->prepare("SELECT id,title,year,plot,genres,directors,cast FROM $this->table ORDER BY Rand() LIMIT 0,$num");
        $requete->execute();
        return $requete->fetchAll();
    }
}
