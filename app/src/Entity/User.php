<?php

namespace Gladblog\Entity;

use Gladblog\Interfaces\PasswordProtectedInterface;
use Gladblog\Interfaces\UserInterface;

class User extends BaseEntity implements UserInterface, PasswordProtectedInterface
{
    private ?int $id = null;
    private string | null $username = null;
    private string | null $password = null;
    private string | null $email = null;
    private string | null $first_name = null;
    private string | null $last_name = null;
    private string | null $birth_date = null;
    private string | null $gender = null;
    private ?string $status = null;
    private array | null $roles = [];

    /**
     * @return int
     */
    public function getId(): int | null
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

     public function setStatus(string | null $status): User
     {
         $this->status = $status;
         return $this;
     }

   public function getStatus(): string | null
   {
       return $this->status;
   }

    /**
     * @return ?string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param ?string $username
     * @return User
     */
    public function setUsername(?string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBirth_date(): ?string
    {
        return $this->birth_date;
    }

    /**
     * @param string|null $birth_date
     * @return $this
     */
    public function setBirth_date(?string $birth_date): User
    {
        $this->birth_date = $birth_date;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getEmail(): string | null
    {
        return $this->email;
    }

    /**
     * @param ?string $email
     * @return User
     */
    public function setEmail(string | null $email): User | null
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirst_name(): ?string
    {
        return $this->first_name;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirst_name(?string $first_name): User
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLast_name(): ?string
    {
        return $this->last_name;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLast_name(?string $last_name): User
    {
        $this->last_name = $last_name;
        return $this;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    // le password en dur sans hashage n'est accessible que depuis cette class
    private function getPassword(): ?string
    {
        return $this->password;
    }

    public function getHashedPassword(): ?string
    {
        // On hash le mot de passe avec Bcrypt, via un coût de 12
        $cost = ['cost' => 12];
        $password = $this->getPassword();
        password_hash($password, PASSWORD_BCRYPT, $cost);
        return $password;
    }
    // Comment utiliser cette méthode sans refaire sans cesse un hashage ? Méthode inutilisée.
    public function passwordMatch(?string $plainPwd): bool
    {
        $hash = $this->getHashedPassword();
        if (password_verify($plainPwd, $hash)){
            return true;
        }
        else{
            return false;
        }
    }

}
