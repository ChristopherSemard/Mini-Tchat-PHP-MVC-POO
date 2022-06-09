<?php

namespace Application\Controllers\SignIn;


class SignIn
{

    public function displayFormSignIn()
    {
        session_start();
        require('../templates/sign-in.php');
        unset($_SESSION['ERROR_SIGNIN']);
        unset($_SESSION['ERROR_SIGNIN_INPUT']);
    }
}
