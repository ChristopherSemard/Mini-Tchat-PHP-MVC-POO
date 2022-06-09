<?php

namespace Application\Lib\Database;

class DatabaseConnection
{
    public ?\PDO $database = null;

    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO('mysql:host=localhost:3308;dbname=mini-tchat;charset=utf8', 'root', '');
        }

        return $this->database;
    }
}
