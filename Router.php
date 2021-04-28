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
        // retirer les variables get de mon url
        $get = explode("?", $call);
        // empecher l'affichage des dossier user/,film/ etc..
        // décomposer mon url à partir des /

        $url = $get[0] . "/";

        // le lance une boucle pour vérifier les éléménts de mon tableau
        // le 1er element de mon tableau sera la racine (ici videotheque)
        // le deuxième sera soit un fichier.php soit un dossier -> à verifier avec l'extension
        // si c'est un dossier je le stock dans une variable
        // si c'est un fichier je stop ma boucle
        // pour les éléments suivant je doit comparer l'element i-1 pour savoir s'ils sont identiques(dossiers)
        // pour finir je reconstruit mon url sans les dossiers en doublons 
        // et $_SERVER['REQUEST_URI'] = $url pour rectifier l'url dans le navigateur 

        // Un switch serait mieux
        if ($url === "/videotheque/home") {
            include("Views/" . self::$route['home']);
        } else if ($url === "/videotheque/singleFilm/") {
            include("Views/" . self::$route['singleFilm']);
        } else if ($url === "/videotheque/filmListBy/") {
            include("Views/" . self::$route['searchFilm']);
        } else if ($url === "/videotheque/registration/") {
            include("Views/" . self::$route['registration']);
        } else {
            include("Views/" . self::$route['home']);
        }
    }
}
