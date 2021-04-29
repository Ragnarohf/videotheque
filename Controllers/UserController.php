<?php

namespace App\Controllers;

use App\Models\UserModel;
require_once("../vendor/autoload.php");
use Gumlet\ImageResize;
class UserController
{

    private $_id_user;
    private $_name; //obli
    private $_email; //obli
    private $_pwd; //obli
    private $_pwd2; //obli
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
                self::$erreur["email"] = "L'adresse email n'est pas valide!";
            }
            $post['pwd'] = self::verifInput('pwd', true);
            $post['pwd2'] = self::verifInput('pwd2', true);
            if ($post['pwd'] !== $post['pwd2']) {
                self::$erreur["pwd"] = "Les deux mots de passe ne correspondent pas!";
            } else {
                $post['pwd'] = password_hash($post['pwd'],PASSWORD_DEFAULT);
            }
            $post['role'] = 'role_user';
            $post['created_at'] = date("Y-m-d");


            if (!empty($post['rgpd'])) {
                if ($post['rgpd'] !== 'on') {
                    self::$erreur["rgpd"] = "Merci de cocher la case rgpd!";
                }
            } else {
                self::$erreur["rgpd"] = "Merci de cocher la case rgpd!";
            }


            // detection de la conformité de l'avatar
            if ($files['avatar']['size'] > 0 && $files['avatar']['error'] === 0) {
                if ($files['avatar']['type'] === 'image/jpeg' || $files['avatar']['type'] === 'image/jpg' || $files['avatar']['type'] === 'image/gif' || $files['avatar']['type'] === 'image/png' || $files['avatar']['type'] === 'image/webp') {
                    $post['avatar'] = $files['avatar'];
                } else {
                    self::$erreur['avatar'] =  "Le fichier avatar n'est pas au bon format.";
                }
            }

            
            if (count(self::$erreur) === 0) {
                $user = new UserModel();
                
                // verifier la présence d'un mail identique attributs ["email"=>$poste['email']]
                $return = $user->findby(['email'=>$post['email']]);
                $return = false;//test
                if(!$return){
                    $user->insert($post);
                    // 50 utilisateurs
                    // le 50e est un gros con (il a un id_user = 50)
                    // l'admin le delete ( id_user = 50 ne sera pas disponible)
                    // je ne peux pas me contenter d'une simple incrémentation sur l'id_user
                    // récupération du dernier id enregistré
                    $tbUser = $user->findAll("ORDER BY id_user");
                    /* debug
                    var_dump($tbUser);
                    $max = count($tbUser)-1;
                    var_dump($tbUser[$max]->id_user); */
                    $lastId = $tbUser[count($tbUser)-1]->id_user;
                    //echo  ROOT.'/public/assets/img/upload';
                    if(!empty($post['avatar']) && isset($post['avatar'])){
                        $ext = explode("/", $post['avatar']['type']);
                        move_uploaded_file ( $post['avatar']['tmp_name'] , "../public/assets/img/upload/".$lastId.".".$ext[1] );
                        //modifier mon image en taille avec ImageResize
                        $image = new ImageResize("../public/assets/img/upload/".$lastId.".".$ext[1]);
                        $image->resizeToWidth(150);
                        $image->save("../public/assets/img/upload/".$lastId.".".$ext[1]);
                        //update => inserer la nouvelle url d'avatar
                        $user->update(['avatar'=>$lastId.".".$ext[1]], ['id_user'=>$lastId]);
                        $result = $user->findby(['id_user'=>$lastId]);
                        $_SESSION['user'] = $result[0];
                        header("Location: home");
                    }
                } else {
                    self::$erreur['email'] = "Cette utilisateur est déjà enregistré.";
                }
            }
            // je renvoie ici un tableau qui contiendra les erreurs et les dionnées déjà envoyées par l'utilisateur
            return [self::$erreur,$post];
        }
    }

    public static function login($post){
        if (!empty($post) && isset($post)) {
            
            $user = new UserModel();
            //email
            $post['email'] = self::verifInput('email', true);
            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                self::$erreur["email"] = "L'adresse email n'est pas valide!";
            }
            $post['pwd'] = self::verifInput('pwd', true);
            
            $result = $user->findby(['email'=>$post['email']]);
            
            if($result){
                if (password_verify($post['pwd'], $result[0]->pwd)) {
                    // login
                    if (count(self::$erreur) === 0) {
                        $_SESSION['user'] = $result[0];   
                        header("Location:home");
                    }
                } else {
                    self::$erreur["pwd"] = "password invalid!";
                }
            } else {
                self::$erreur["email"] = "inconnu";
            }
        }

    }
    
    /**
     * adminFindAll
     *
     * @return void
     */
    public function adminFindAll(){
        $user = new UserModel;
        $adminFindAll = $user->findAll();
        return $adminFindAll;
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
