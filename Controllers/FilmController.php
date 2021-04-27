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
        $filmModel->selectList($order, $offset, $limit);
        return $filmModel;
    }
}
