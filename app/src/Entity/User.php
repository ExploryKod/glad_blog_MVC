<?php

namespace Gladblog\Entity;

use Gladblog\Interfaces\PasswordProtectedInterface;
use Gladblog\Interfaces\UserInterface;

class User extends BaseEntity implements UserInterface, PasswordProtectedInterface
{
    private ?int $id;
    private string $username;
    private string $password;
    private string | null $email;
    private string | null $firstName;
    private string | null $lastName;
    private string | null $gender;
    private array | null $roles = [];

    /**
     * @return int
     */
    public function getId(): int
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
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return User
     */
    public function setGender(string $gender): User
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): ?array
    {
        $roles = $this->roles;
        $roles[] = "ROLE_USER";
        return $roles;
    }

    /**
     * @param array $roles
     * @return User
     */
    public function setRoles(array $roles): User
    {
        $this->roles = $roles;
        return $this;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    // le password en dur sans hashage n'est accessible que depuis cette class
    private function getPassword(): string
    {
        return $this->password;
    }

    public function getHashedPassword(): string
    {
        // On hash le mot de passe avec Bcrypt, via un coût de 12
        $cost = ['cost' => 12];
        $password = $this->getPassword();
        password_hash($password, PASSWORD_BCRYPT, $cost);
        return $password;
    }

    public function passwordMatch(string $plainPwd, $hash): bool
    {
        if (password_verify($plainPwd, $hash)){
            return true;
        }
        else{
            return false;
        }
    }
}
