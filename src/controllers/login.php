<?php

namespace Application\Controllers\Login;

require_once('../src/lib/database.php');
require_once('../src/model/User.php');


use Application\Lib\Database\DatabaseConnection;
use Application\Model\User\User;

class Login
{
    public function displayFormLogin()
    {
        session_start();
        require('../templates/login.php');
        unset($_SESSION['ERROR_LOGIN']);
        unset($_SESSION['ERROR_LOGIN_INPUT']);
    }

    
    public function login($input)
    {
        session_start();
        if(!empty($input)) {
            if(isset($input['pseudo']) && !empty($input['pseudo']) && isset($input['password']) && !empty($input['password'])) {
                $user = new User;
                $user->connection = new DatabaseConnection();
                $userTable = $user->getUserByPseudo(strip_tags($input['pseudo']));


                if(!$userTable){
                    $_SESSION['ERROR_LOGIN'] = 'Le pseudo renseigné n\'existe pas, veuillez créer un compte ou réessayer.';
                    $_SESSION['ERROR_LOGIN_INPUT'] = $input;
                    header('Location: ../index.php?action=login');
                    exit;
                }

                // if(password_verify($input['password'], $user->password)) {
                if($input['password'] == $userTable->password) {
                    $user->createSession($userTable);
                    header('Location: ../index.php');
                    exit;
                } else {
                    $_SESSION['ERROR_LOGIN'] = 'Le pseudo et/ou le mot de passe est incorrect.';
                    $_SESSION['ERROR_LOGIN_INPUT'] = $input;
                    header('Location: ../index.php?action=login');
                    exit;
                } 
                
            } else {
                $_SESSION['ERROR_LOGIN'] = "Un des champs n'est pas rempli.";
                $_SESSION['ERROR_LOGIN_INPUT'] = $input;
                header('Location: ../index.php?action=login');
                exit;
            }
        }                                          
    }



}

