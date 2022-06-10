<?php

namespace Application\Controllers\SignIn;

require_once('../src/lib/database.php');
require_once('../src/model/User.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\User\User;

class SignIn
{

    public string $regexPseudo = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,100}$/u";
    public string $regexPassword = "/^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/";

    public function displayFormSignIn()
    {
        session_start();
        require('../templates/sign-in.php');
        unset($_SESSION['ERROR_SIGNIN']);
        unset($_SESSION['ERROR_SIGNIN_INPUT']);
    }



    public function signin($input)
    {
        session_start();
        if(!empty($input)) {
            if(isset($input['pseudo']) && !empty($input['pseudo']) && isset($input['password']) && !empty($input['password']) && isset($input['password-confirm']) && !empty($input['password-confirm']) && isset($input['color']) && !empty($input['color'])) {
            
                $user = new User;
                $user->pseudo = strip_tags($input['pseudo']);
                $user->password = strip_tags($input['password']);
                $user->color = strip_tags($input['color']);
                $user->createDBConnection();
                $userTable = $user->getUserByPseudo($user->pseudo);
                if($userTable){
                    $_SESSION['ERROR_SIGNIN'] = 'Le pseudo existe déjà, merci d\'en choisir un autre.';
                    $_SESSION['ERROR_SIGNIN_INPUT'] = $input;
                    header('Location: ../index.php?action=signin');
                    exit;
                }
                else if($user->password != $input['password-confirm']) {
                    $_SESSION['ERROR_SIGNIN'] = 'Vos mots de passe ne correspondent pas.';
                    $_SESSION['ERROR_SIGNIN_INPUT'] = $input;
                    header('Location: ../index.php?action=signin');
                    exit;
                } 
                else if (!preg_match($this->regexPseudo, $user->pseudo)){
                    $_SESSION['ERROR_SIGNIN'] = 'Votre pseudo n\'est pas valide';
                    $_SESSION['ERROR_SIGNIN_INPUT'] = $input;
                    header('Location: ../index.php?action=signin');
                    exit;
                }
                else if (!preg_match($this->regexPassword, $user->password)){
                    $_SESSION['ERROR_SIGNIN'] = 'Votre mot de passe n\'est pas valide';
                    $_SESSION['ERROR_SIGNIN_INPUT'] = $input;
                    header('Location: ../index.php?action=signin');
                    exit;
                }
                
                $test = $user->addUser($user);
                $_SESSION['SUCCESS_SIGNIN'] = 'Félicitation vous êtes inscrit, vous pouvez désormais vous connecter à votre compte !';
                header('Location: ../index.php?action=login');
                exit;      
                
            } else {
                $_SESSION['ERROR_SIGNIN'] = "Un des champs n'est pas rempli.";
                $_SESSION['ERROR_SIGNIN_INPUT'] = $input;
                header('Location: ../index.php?action=signin');
                exit;
            }
        }                                          
    }

}
