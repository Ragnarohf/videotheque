<?php

namespace App;

class Router
{
    private $route = [
        'home' => './film',
        'singleFilm' => './film/film.php',
        'searchFilm' => './film/filmListBy.php',
        'registration' => './user/add.php'

    ];
    public static function start()
    {
        define('ROOT', __DIR__);
        $call = $_SERVER['REQUEST_URI'];

        var_dump(ROOT, $call, $_SERVER);
    }
    public static function getRoute()
    {
    }
}
