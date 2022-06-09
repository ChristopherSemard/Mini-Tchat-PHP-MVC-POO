<?php

namespace Application\Controllers\Homepage;

require_once('../src/lib/database.php');
require_once('../src/model/Message.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Message\MessageRepository;

class Homepage
{
    public function execute()
    {
        $messageRepository = new MessageRepository();
        $messageRepository->connection = new DatabaseConnection();
        $messages = $messageRepository->getMessages();

        require('../templates/homepage.php');
    }
}
