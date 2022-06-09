<?php

namespace Application\Controllers\Logout;

class Logout
{
    public function logout()
    {
        // Import de la session
        session_start();

        // Suppression de la session
        session_destroy();

        var_dump($_SESSION);
        // Redirection vers l'index
        header('Location: ../index.php');
        exit;
    }
}