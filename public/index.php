<?php

require_once('../src/controllers/Homepage.php');
require_once('../src/controllers/Login.php');
require_once('../src/controllers/Logout.php');
require_once('../src/controllers/SignIn.php');
require_once('../src/controllers/AddMessage.php');

use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Login\Login;
use Application\Controllers\Logout\Logout;
use Application\Controllers\SignIn\SignIn;
use Application\Controllers\AddMessage\AddMessage;

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'login') {
            (new Login())->displayFormLogin();
        } elseif ($_GET['action'] === 'submitlogin') {
            $input = null;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
            }
            (new Login())->login($input); 
        } elseif ($_GET['action'] === 'signin') {
            (new SignIn())->displayFormSignIn();
        }  elseif ($_GET['action'] === 'submitsignin') {
            $input = null;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
            }
            (new SignIn())->signin($input); 
        } elseif ($_GET['action'] === 'logout') {
            (new Logout())->logout();
        } elseif ($_GET['action'] === 'submitmessage') {
            $input = null;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
            }
            (new AddMessage())->execute($input);
        } 
    } else {
        (new Homepage())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    echo($errorMessage);
}
