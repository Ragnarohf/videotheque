<?php

namespace App;

class Router
{


    private static $route = [
        'home' => "film/index.php",
        'singleFilm' => 'film/singleFilm.php',
        'searchFilm' => 'film/filmListBy.php',
        'randomFilm' => 'film/randomFilm.php', // ne fonctionne pas dans un include
        'registration' => 'user/add.php',
        'login' => 'user/login.php',
        'logout' => 'user/logout.php',
        'admin' => 'user/admin.php',
        'deleteUser' => 'user/delete.php',
        'newComment' => 'comment/newComment.php',
        'displayComment' => 'comment/displayComment.php',
        'valideComment' => 'comment/valideComment.php',
        'deleteComment' => 'comment/deleteComment.php'

    ];
    // plus malin : un tableau $route avec view ET controller
    /* 
    private static $route = [
        'home'=>["film/index.php","film"]
    ]
    */


    // gerer les sessions dans le router ou créer une autre class
    public static $public;
    public static $view;
    public static $sessionActive;

    // ?? fonction qui sera appelée dans mes controllers à chaque création de page
    // ?? et initialisera une nouvelle route ?
    public static function setRoute($key, $value)
    {
        self::$route[$key] = $value;
    }

    // fonction qui remplacera mais include et permettra d'utiliser les 
    // raccourcis de mon routeur
    public static function setInclude($path)
    {
        foreach (self::$route as $key => $value) {
            if ($path === $key) {
                $url = self::$view . $value;
                include($url);
            }
        }
    }

    public static function start($session)
    {

        define('ROOT', __DIR__);

        /* $rootPath = substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']))));
        var_dump($rootPath); */

        $call = $_SERVER['REQUEST_URI'];
        self::$public = str_replace('\\', '/', ROOT . "/public/");
        self::$view =  str_replace('\\', '/', ROOT . "/Views/");
        self::$sessionActive = $session;
        // retirer les variables get de mon url
        $get = explode("?", $call);
        // empecher l'affichage des dossier user/,film/ etc..
        // décomposer mon url à partir des /
        $url = $get[0] . "/";


        $routeActive = false;
        foreach (self::$route as $key => $value) {
            if ($url === "/videotheque/" . $key . "/") {
                include("Views/" . $value);
                $routeActive = true;
            }
        }
        if (!$routeActive) {
            include("Views/" . self::$route['home']);
        }
        /*

        if($url === "/videotheque/home"){
            include("Views/".self::$route['home']);
        }
        else if($url === "/videotheque/singleFilm/"){
            include("Views/".self::$route['singleFilm']);
        }
        else if($url === "/videotheque/filmListBy/"){
            include("Views/".self::$route['searchFilm']);
        }
        else if($url === "/videotheque/registration/" ){
            include("Views/".self::$route['registration']);
        }
        else if($url === "/videotheque/login/" ){
            include("Views/".self::$route['login']);
        }
        else if($url === "/videotheque/logout/" ){
            include("Views/".self::$route['logout']);
        }
        else if($url === "/videotheque/newComment/" ){
            include("Views/".self::$route['newComment']);
        }
        else {
            include("Views/".self::$route['home']);
        } */
    }
}
