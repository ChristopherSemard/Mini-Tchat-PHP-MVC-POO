<?php

namespace Application\Model\User;

require_once('../src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class User
{
    public int $id;
    public string $pseudo;
    public string $password;
    public string $color;

    protected DatabaseConnection $connection;

    public function getUserByPseudo($pseudo){
        $userStatement = $this->connection->getConnection()->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
        $userStatement->execute(['pseudo' => $pseudo]);
        $userDB = $userStatement->fetch();

        if ($userDB === false) {
            return false;
        }
        $user = new User();
        $user->id = $userDB['id'];
        $user->pseudo = $userDB['pseudo'];
        $user->password = $userDB['password'];
        $user->color = $userDB['color'];
        return $user;
    }

    public function addUser($user){
        $hashPassword = password_hash($user->password, PASSWORD_BCRYPT);
        $statement = $this->connection->getConnection()->prepare('INSERT INTO users (pseudo, password, color) VALUES (:pseudo, :password, :color)');
        $statement->execute(['pseudo' => $user->pseudo,'password' => $hashPassword,'color' => $user->color]);
    }


    public function createSession($user){
        $userTable = [
            'id_user' => $user->id,
            'pseudo' => $user->pseudo,
        ];
        $_SESSION['LOGGED_USER'] = $userTable;
    }
    public function createDBConnection(){
        $this->connection = new DatabaseConnection();
    }
}
