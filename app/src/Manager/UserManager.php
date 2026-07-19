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

    public function getByUserid(string $userId): ?User
    {
        $query = $this->pdo->prepare("SELECT * FROM user WHERE id = :userId");
        $query->bindValue("userId", $userId, \PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            // En retournant l'objet lui-même on peux appeler getByUserName depuis cette class tout en chaînant pour aller chercher les méthodes de User aussi
            return new User($data);
        }

        return null;
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

    public function insertUser(User $user): void
    {
        $query = $this->pdo->prepare("INSERT INTO user (password, username, first_name, last_name, email, birth_date, status, creation_date) 
                                            VALUES (:password, :username, :first_name, :last_name, :email, :birth_date, :status, NOW())");
        $query->bindValue("password", $user->getHashedPassword(), \PDO::PARAM_STR);
        $query->bindValue("username", $user->getUsername(), \PDO::PARAM_STR);
        $query->bindValue("first_name", $user->getFirst_name(), \PDO::PARAM_STR);
        $query->bindValue("last_name", $user->getLast_name(), \PDO::PARAM_STR);
        $query->bindValue("email", $user->getEmail(), \PDO::PARAM_STR);
        $query->bindValue("birth_date", $user->getBirth_date(), \PDO::PARAM_STR);
        $query->bindValue("status", $user->getStatus() ?? User::STATUS_USER, \PDO::PARAM_STR);
        $query->execute();
    }

    public function setAdminRights(User $user): void
    {
        $user->promoteToAdmin();

        $query = $this->pdo->prepare("UPDATE user SET status = :status WHERE id=:userId ");
        $query->execute([
            'status' => $user->getStatus(),
            'userId' => $user->getId()
        ]);
    }

    /**
     * @param int|null $userId
     * @param string|null $username
     * @return void
     */
    public function deleteUser(int | null $userId, string | null $username): void
    {
        $dropUserReq = $this->pdo->prepare("DELETE FROM user WHERE id = :userId AND username = :username");
        $dropUserReq->bindValue("userId", $userId, \PDO::PARAM_STR);
        $dropUserReq->bindValue("username", $username, \PDO::PARAM_STR);
        $dropUserReq->execute();
    }

    public function updateUser(User $user): void
    {
        $query = $this->pdo->prepare(
            "UPDATE user SET
                username = :username,
                password = :password,
                first_name = :first_name,
                last_name = :last_name,
                email = :email,
                birth_date = :birth_date,
                status = :status
             WHERE id = :userId"
        );
        $query->execute([
            'username' => $user->getUsername(),
            'password' => $user->getHashedPassword(),
            'first_name' => $user->getFirst_name(),
            'last_name' => $user->getLast_name(),
            'email' => $user->getEmail(),
            'birth_date' => $user->getBirth_date(),
            'status' => $user->getStatus(),
            'userId' => $user->getId(),
        ]);
    }
}
