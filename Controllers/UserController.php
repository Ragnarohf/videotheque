<?php

namespace App\Controllers;

use App\Models\UserModel;

require_once("../../vendor/autoload.php");

use Gumlet\ImageResize;

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

            $post['name'] = self::verifInput('name', true);
            $post['email'] = self::verifInput('email', true);
            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                self::$erreur["email"] = "L'adresse Mail n'est pas valide";
            }
            $post['pwd'] = self::verifInput('pwd', true);
            $post['pwd2'] = self::verifInput('pwd2', true);
            if ($post['pwd'] !== $post['pwd2']) {
                self::$erreur["pwd"] = "Les deux mots de passes ne correspondent pas!";
            } else {
                $post['pwd'] = password_hash($post['pwd'], PASSWORD_DEFAULT);
            }
            $post['role'] = "role_user";
            $post['created_at'] = date('Y-m-d');


            if (!empty($post['rgpd'])) {
                if ($post['rgpd'] !== 'on') {
                    self::$erreur['rgpd'] = "Merci de cocher la case rgpd!";
                }
            } else {
                self::$erreur['rgpd'] = "Merci de cocher la case rgpd!";
            }

            //detection de la conformité de l'avatar;
            if ($files['avatar']['size'] > 0 && $files['avatar']['error'] === 0) {
                if ($files['avatar']['type'] === "image/png" || $files['avatar']['type'] === "image/jpeg" || $files['avatar']['type'] === "image/jpg" || $files['avatar']['type'] === "image/gif" || $files['avatar']['type'] === "image/webp") {
                    $post['avatar'] = $files["avatar"];
                } else {
                    self::$erreur["avatar"] = "Le fichier avatar n'est pas au bon format.";
                }
            }


            if (count(self::$erreur) === 0) {

                $user = new UserModel();
                //verifier la presence d'un mail identique attributs ["email"=>$post['email']]
                $return = $user->findBy(['email' => $post['email']]);

                if (!$return) {
                    // trouver un moyen de recuperer l'id_user de mon nouvel enregistrement
                    // 50utilisateurs
                    //le 50eme est un gros con (il a un id_user =50)
                    // l'admin le delete (l'id_user = 50 ne seras pas disponible )
                    //je ne peux pas me contenter d'une simple incrementation sur l'id_user
                    $user->insert($post);
                    //recuperation du dernier id enregistrés
                    $tbUser = $user->findALl(" ORDER BY id_user");
                    $max = count($tbUser) - 1;
                    $lastId = $tbUser[$max]->id_user;
                    var_dump($lastId);
                    // echo ROOT./public/assets/img/upload
                    if (!empty($post['avatar']) && isset($post['avatar'])) {
                        $ext = explode("/", $post['avatar']['type']);
                        var_dump($ext[1]);
                        move_uploaded_file($post['avatar']['tmp_name'], '../../public/assets/img/upload/' . $lastId . "." . $ext[1]);
                        $image = new ImageResize('../../public/assets/img/upload/' . $lastId . "." . $ext[1]);
                        $image->resizeToWidth(150);
                        $image->save('../../public/assets/img/upload/' . $lastId . "." . $ext[1]);
                        // update->inserer dans la nouvelle url de l'avatar
                        $user->update(['avatar' => $lastId . "." . $ext[1]], ['id_user' => $lastId]);
                        header("Location:../home.php");
                    }
                } else {
                    self::$erreur['email'] = 'cet utilisateur est deja enregistré.';
                }
            }
            //renvoie un tableau et les donnes des user deja envoyé 
            return [self::$erreur, $post];
        }
        var_dump(self::$erreur);
    }

    public static function verifInput($input, $obligatoire = false, $type = false)
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
