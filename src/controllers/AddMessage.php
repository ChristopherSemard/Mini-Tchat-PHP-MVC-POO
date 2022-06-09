<?php

namespace Application\Controllers\AddMessage;


require_once('../src/lib/database.php');
require_once('../src/model/Message.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Message\MessageRepository;


class AddMessage{

    public function execute($input)
    {
        session_start();
        if(!empty($input)) {
            if(isset($input['message']) && !empty($input['message'])) {
                $message = new MessageRepository;
                $message->connection = new DatabaseConnection();

                if(strlen(strip_tags($input['message'])) > 0) {
                    $message->addMessage(strip_tags($input['message']), $_SESSION['LOGGED_USER']['id_user']);
                    header('Location: ../index.php');
                    exit;
                } else {
                    $_SESSION['ERROR_MESSAGE'] = 'Le champ de message est vide';
                    header('Location: ../index.php');
                    exit;
                } 
                
            } else {
                $_SESSION['ERROR_MESSAGE'] = "Un des champs n'est pas rempli.";
                header('Location: ../index.php');
                exit;
            }
        }           
    }    

}