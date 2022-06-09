<?php

namespace Application\Model\Message;

require_once('../src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Message
{
    public string $pseudo;
    public string $date;
    public string $color;
    public string $text;
}

class MessageRepository
{
    public DatabaseConnection $connection;

    public function getMessages(): array
    {
        $statement = $this->connection->getConnection()->query(
            'SELECT *, DATE_FORMAT(messages.date, "%e/%c/%Y %k:%i") as date_format FROM messages INNER JOIN users ON users.id = messages.user_id ORDER BY messages.id DESC'
        );
        $messages = [];
        while (($row = $statement->fetch())) {
            $message = new Message();
            $message->pseudo = $row['pseudo'];
            $message->date = $row['date_format'];
            $message->color = $row['color'];
            $message->text = $row['message'];

            $messages[] = $message;
        }
        return $messages;
    }

    public function addMessage($message, $userId)
    {
        $statement = $this->connection->getConnection()->prepare('INSERT INTO messages (message, user_id, date) VALUES (:message, :user_id, NOW())');
        $statement->execute(['message' => $message,'user_id' => $userId]);
    }
}