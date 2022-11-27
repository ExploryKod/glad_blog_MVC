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
        $query->bindValue("username", $userId, \PDO::PARAM_STR);
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

    /**
     * @param mixed $plainPassword
     * @param array $cost
     * @return string
     */
    private function makeHashedPassword(mixed $plainPassword, array $cost = ['cost' => 12]) : string   {
        $password = password_hash($plainPassword, PASSWORD_BCRYPT, $cost);
        return $password;
    }

    /**
     * @param string|null $password
     * @param string|null $username
     * @return void
     */
    public function insertUser(string | null $password, string | null $username, string | null $first_name, string | null $last_name, string | null $birth_date, string | null $email) : void
    {
        $cost = ['cost' => 12];
        $password = $this->makeHashedPassword($password, $cost);
        $status = 'user';
        $query = $this->pdo->prepare("INSERT INTO user (password, username, first_name, last_name, email, birth_date, status, creation_date) 
                                            VALUES (:password, :username, :first_name, :last_name, :email, :birth_date, :status, NOW())");
        $query->bindValue("password", $password, \PDO::PARAM_STR);
        $query->bindValue("username", $username, \PDO::PARAM_STR);
        $query->bindValue("first_name", $first_name, \PDO::PARAM_STR);
        $query->bindValue("last_name", $last_name, \PDO::PARAM_STR);
        $query->bindValue("email", $email, \PDO::PARAM_STR);
        $query->bindValue("birth_date", $birth_date, \PDO::PARAM_STR);
        $query->bindValue("status", $status, \PDO::PARAM_STR);
        $query->execute();
    }

    public function setAdminRights(int $userId, string $status)  {

        $query = $this->pdo->prepare("UPDATE user SET status = :status WHERE id=:userId ");
        $query->execute([
            'status' => $status,
            'userId' => $userId
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

    /**
     * @param int|null $userId
     * @param string|null $username
     * @param array $args
     * @return void
     */
    public function updateUser(int | null $userId, string | null $username, array $args = []): void
    {

        if(!empty($args)) {
            foreach($args as $key => $value) {
                if(!empty($key)){
                    switch ($key) {
                        case 'username':
                            $username = $args['username'];
                            $query = $this->pdo->prepare("UPDATE user SET username = :username WHERE id=:userId ");
                            $query->bindValue("username", $username, \PDO::PARAM_STR);
                            $query->bindValue("userId", $userId, \PDO::PARAM_STR);
                            $query->execute();
                            break;
                        case 'password':
                            $password = $args['password'];
                            $query = $this->pdo->prepare("UPDATE user SET password = :password WHERE id=:userId ");
                            $query->bindValue("password", $password, \PDO::PARAM_STR);
                            $query->bindValue("userId", $userId, \PDO::PARAM_STR);
                            $query->execute();
                            break;
                        case 'first_name':
                            $first_name = $args['first_name'];
                            $query = $this->pdo->prepare("UPDATE user SET first_name = :first_name WHERE id=:userId ");
                            $query->bindValue("first_name", $first_name, \PDO::PARAM_STR);
                            $query->bindValue("userId", $userId, \PDO::PARAM_STR);
                            $query->execute();
                            break;
                        case 'last_name':
                            $last_name = $args['last_name'];
                            $query = $this->pdo->prepare("UPDATE user SET last_name = :last_name WHERE id=:userId ");
                            $query->bindValue("last_name", $last_name, \PDO::PARAM_STR);
                            $query->bindValue("userId", $userId, \PDO::PARAM_STR);
                            $query->execute();
                            break;
                        case 'birth_date':
                            $birth_date = $args['birth_date'];
                            $query = $this->pdo->prepare("UPDATE user SET birth_date = :birth_date WHERE id=:userId ");
                            $query->bindValue("birth_date", $birth_date, \PDO::PARAM_STR);
                            $query->bindValue("userId", $userId, \PDO::PARAM_STR);
                            $query->execute();
                            break;
                        case 'email':
                            $email = $args['email'];
                            $query = $this->pdo->prepare("UPDATE user SET email = :email WHERE id=:userId ");
                            $query->bindValue("email", $email, \PDO::PARAM_STR);
                            $query->bindValue("userId", $userId, \PDO::PARAM_STR);
                            $query->execute();
                            break;
                        case 'status':
                            $status = $args['status'];
                            $query = $this->pdo->prepare("UPDATE user SET status = :status WHERE id=:userId ");
                            $query->bindValue("status", $status, \PDO::PARAM_STR);
                            $query->bindValue("userId", $userId, \PDO::PARAM_STR);
                            $query->execute();
                            break;

                    }
                }
            }
        }
    }
}
