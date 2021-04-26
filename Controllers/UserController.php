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
    public static $erreur = [];

    public static function validator($post, $files)
    {
        if (!empty($post) && isset($post)) {
            var_dump($post, $files);
            $post['name'] = self::verifInput('name', true);
            $post['email'] = self::verifInput('email', true);
            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                self::$erreur["email"] = "L'adresse Mail n'est pas valide";
            }
            $post['pwd'] = self::verifInput('pwd', true);
            $post['pwd2'] = self::verifInput('pwd2', true);
            if ($post['pwd'] !== $post['pwd2']) {
                self::$erreur["pwd"] = "Les deux mots de passes ne correspondent pas!";
            }
            $post['role'] = "role_user";
            $post['created_at'] = date('Y-m-d');
            if (!empty($post["rgpd"]) && $post['rgpd'] !== 'on') {
                self::$erreur['rgpd'] = "Merci de cocher la case rgpd";
            }
            //detection de la conformité de l'avatar;
            if ($files['avatar']['size'] > 0 && $files['avatar']['error'] === 0) {
                if ($files['avatar']['type'] === "image/png" || $files['avatar']['type'] === "image/jpeg" || $files['avatar']['type'] === "image/jpg" || $files['avatar']['type'] === "image/gif" || $files['avatar']['type'] === "image/webp") {
                    $post['avatar'] = $files["avatar"]["tmp_name"];
                } else {
                    self::$erreur["avatar"] = "Le fichier avatar n'est pas au bon format.";
                }
            }



            if (count(self::$erreur) === 0) {
            }
        }
    }

    public static function verifInput($input, $obligatoire = false, $type = false)
    {
        if (!empty($_POST[$input]) && isset($_POST[$input])) {
            $retour = trim(strip_tags($_POST[$input]));
        } else {

            if ($obligatoire) {
                var_dump($input);
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
