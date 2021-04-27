<?php


namespace App\Controllers;

use App\Models\FilmModel;

require_once("../../vendor/autoload.php");

use Gumlet\ImageResize;

class FilmController
{
    public function list($order, $offset, $limit) //je propose a l'user un order et une limit
    {
        $filmModel = new FilmModel;
        $resultFilmModel = $filmModel->selectList($order, $offset, $limit);

        return $resultFilmModel;
    }
    public function film($id)
    {
        $filmModel = new FilmModel;
        $resultFilmModel = $filmModel->findby(["id" => $id]);
        $rating = $resultFilmModel[0]->rating;
        $rating = ceil($rating / 20);
        $resultFilmModel[0]->rating = $rating;
        var_dump($rating);

        return $resultFilmModel;
    }
    public function randomFilm($num)
    {
        $filmModel = new FilmModel;
        $randomFilm = $filmModel->randomFilm($num);
        return  $randomFilm;
    }
}
