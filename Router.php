<?php

namespace App;

class Router
{

    private static $route = [
        'home' => "film/index.php",
        'singleFilm' => 'film/singleFilm.php',
        'searchFilm' => 'film/filmListBy.php',
        'registration' => 'user/add.php'
    ];
    public static $public;
    public static $view;


    public static function start()
    {
        define('ROOT', __DIR__);
        $call = $_SERVER['REQUEST_URI'];
        self::$public = ROOT . "/public/";
        self::$view = ROOT . "/Views/";
        $get = explode("?", $call);

        if ($get[0] === "/videotheque/") {
            include("Views/" . self::$route['home']);
        } else if ($get[0] === "/videotheque/film/singleFilm.php") {
            include("Views/" . self::$route['singleFilm']);
        } else if ($get[0] === "/videotheque/film/filmListBy.php") {
            include("Views/" . self::$route['searchFilm']);
        } else if ($get[0] === "/videotheque/user/add.php") {
            include("Views/" . self::$route['registration']);
        } else {
            include("Views/" . self::$route['home']);
        }
    }
}
