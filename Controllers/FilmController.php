<?php

namespace App\Controllers;

use App\Models\FilmModel;

require_once("../vendor/autoload.php");
use Gumlet\ImageResize;
class FilmController
{


    public function list($order,$offset,$limit){//je propose à l'utilisateur un order et une limite
        $filmModel = new FilmModel;
        // CRETIN
        $resultFilmModel = $filmModel->selectList($order,$offset,$limit);
        return $resultFilmModel;
    }
    public function film($id){
        $filmModel = new FilmModel;
         $resultFilmModel = $filmModel->findby(['id'=>$id]);
         // exemple de manipulation des données depuis mon
         $rating = $resultFilmModel[0]->rating;
         $rating = ceil($rating/20);
         $resultFilmModel[0]->rating = $rating;
         // transformation de cast en tableau
         $cast = explode(", ",$resultFilmModel[0]->cast);
         $resultFilmModel[0]->cast = $cast;
         return $resultFilmModel;
    }
    public function randomFilm($num){
        $filmModel = new FilmModel;
        $randomFilm = $filmModel->randomFilm($num);
        return $randomFilm;
    }
    public function filmListBy($key,$value){
        $filmModel = new FilmModel;
        $filmListBy = $filmModel->filmListBy($key,$value);
        return $filmListBy;
    }

}