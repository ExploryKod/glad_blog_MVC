<?php

namespace Gladblog\Manager;

use Gladblog\Entity\User;

class UserManager extends BaseManager
{

    /**
     * @return User[]
     */
    public function getAllUsers(): array
    {
        $query = $this->pdo->query("select * from user");

        $users = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = new User($data);
        }

        return $users;
    }

    public function getByUsername(string $username): ?User
    {
        $query = $this->pdo->prepare("SELECT * FROM user WHERE username = :username");
        $query->bindValue("username", $username, \PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            // En retournant l'objet lui-même on peux appeler getByUserName depuis cette class tout en chaînant pour aller chercher les méthodes de User aussi
            return new User($data);
        }

        return null;
    }

    public function insertUser(string $password, string $username)
    {
        $cost = ['cost' => 12];
        $password = password_hash($password, PASSWORD_BCRYPT, $cost);
        $query = $this->pdo->prepare("INSERT INTO user (password, username) VALUES (:password, :username)");
        $query->bindValue("password", $password, \PDO::PARAM_STR);
        $query->bindValue("username", $username, \PDO::PARAM_STR);
        $query->execute();
    }

    public function deleteUser(int | null $userId, string | null $username)
    {
        $dropUserReq = $this->pdo->prepare("DELETE FROM user WHERE id = :userId AND username = :username");
        $dropUserReq->bindValue("userId", $userId, \PDO::PARAM_STR);
        $dropUserReq->bindValue("username", $username, \PDO::PARAM_STR);
        $dropUserReq->execute();
    }
}
