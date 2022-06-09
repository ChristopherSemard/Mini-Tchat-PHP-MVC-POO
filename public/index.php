<?php

require_once('../src/controllers/sign-in.php');
require_once('../src/controllers/login.php');
require_once('../src/controllers/log-out.php');
require_once('../src/controllers/add-message.php');
require_once('../src/controllers/home.php');

use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Login\Login;
use Application\Controllers\SignIn\SignIn;

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'login') {
            (new Login())->execute();
        } else if ($_GET['action'] === 'signin') {
            (new SignIn())->execute();
        }
    } else {
        (new Homepage())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require('templates/error.php');
}
