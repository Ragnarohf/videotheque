<?php

namespace App\Controllers;

class UserController
{
    private $_id_user; // obligatoire
    private $_name; // obligatoire
    private $_email; // obligatoire
    private $_pwd; // obligatoire
    private $_pwd2; // obligatoire
    private $_avatar;
    private $_role;
    private $_created_at;
    public $erreur = [];

    public function validator($post, $files)
    {
        if (!empty($post) && isset($post)) {
            $post['name'] = $this->verifInput('name', true);
            $post['email'] = $this->verifInput('email', true);
            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                self::$erreur["email"] = "L'adresse Mail n'est pas valide";
            }
            $post['pwd'] = $this->verifInput('pwd', true);
            $post['pwd2'] = $this->verifInput('pwd2', true);
            if ($post['pwd'] !== $post['pwd2']) {
                self::$erreur["pwd"] = "Les deux mots de passes ne correspondent pas!";
            }
            $post['role'] = "role_user";
            $post['created_at'] = date('Y-m-d');
        }
    }

    public function verifInput($input, $obligatoire = false, $type = false)
    {
        if (!empty($_POST[$input]) && isset($_POST[$input])) {
            $retour = trim(strip_tags($_POST[$input]));
        } else {

            if ($obligatoire) {
                $retour = "";
                self::$erreur[$input] = "Le champ $input n'est pas rempli.";
            } else {
                $retour = "";
            }
        }
        if ($type && $retour !== "") {

            switch ($type) {
                case 'integer':
                    $patern = "@[0-9]@";
                    if (!preg_match($patern, $retour)) {
                        self::$erreur[$input] = "Le champ $input n'est pas au bon format.";
                    } else {
                        $retour = intval($retour);
                    }
                    break;
                case 'string':
                    $retour = strval($retour);
                    break;

                default:

                    $retour = "";
                    break;
            }
        }
        return $retour;
    }
}
