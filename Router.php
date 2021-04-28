<?php

namespace App;

class Router
{


    private static $route = [
        'home' => "film/index.php",
        'singleFilm' => 'film/singleFilm.php',
        'searchFilm' => 'film/filmListBy.php',
        'registration' => 'user/add.php',
        'login' => 'user/login.php',
        'logout' => 'user/logout.php',
        'newComment' => 'comment/newComment.php'
    ];
    public static $public;
    public static $view;
    public static $sessionActive;


    public static function start($session)
    {
        define('ROOT', __DIR__);
        $call = $_SERVER['REQUEST_URI'];
        self::$public = ROOT . "/public/";
        self::$view = ROOT . "/Views/";
        self::$sessionActive = $session;
        // retirer les variables get de mon url
        $get = explode("?", $call);
        // empecher l'affichage des dossier user/,film/ etc..
        // décomposer mon url à partir des /
        $url = $get[0] . "/";

        // Un switch serait mieux
        if ($url === "/videotheque/home") {
            include("Views/" . self::$route['home']);
        } else if ($url === "/videotheque/singleFilm/") {
            include("Views/" . self::$route['singleFilm']);
        } else if ($url === "/videotheque/filmListBy/") {
            include("Views/" . self::$route['searchFilm']);
        } else if ($url === "/videotheque/registration/") {
            include("Views/" . self::$route['registration']);
        } else if ($url === "/videotheque/login/") {
            include("Views/" . self::$route['login']);
        } else if ($url === "/videotheque/logout/") {
            include("Views/" . self::$route['logout']);
        } else if ($url === "/videotheque/newComment/") {
            include("Views/" . self::$route['newComment']);
        } else {
            include("Views/" . self::$route['home']);
        }
    }
}
