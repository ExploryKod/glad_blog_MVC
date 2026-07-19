<?php

namespace Gladblog\Entity;

use Gladblog\Exception\DomainException;
use Gladblog\Interfaces\PasswordProtectedInterface;
use Gladblog\Interfaces\UserInterface;

class User extends BaseEntity implements UserInterface, PasswordProtectedInterface
{
    public const STATUS_USER = 'user';
    public const STATUS_ADMIN = 'admin';

    /**
     * @var array<string, string>
     */
    protected array $hydrationMap = [
        'id' => 'setId',
        'username' => 'setUsername',
        'password' => 'setPassword',
        'email' => 'setEmail',
        'first_name' => 'setFirst_name',
        'last_name' => 'setLast_name',
        'birth_date' => 'setBirth_date',
        'status' => 'setStatus',
    ];

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
     * Crée un nouvel utilisateur avec mot de passe hashé et statut "user".
     */
    public static function register(
        string $username,
        string $plainPassword,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $birthDate = null,
        ?string $email = null
    ): self {
        $username = trim($username);
        if ($username === '') {
            throw new DomainException('Le nom d\'utilisateur est obligatoire.');
        }
        if (strlen($plainPassword) < 4) {
            throw new DomainException('Le mot de passe doit contenir au moins 4 caractères.');
        }

        $user = new self();
        $user->setUsername($username)
            ->setFirst_name($firstName)
            ->setLast_name($lastName)
            ->setBirth_date($birthDate)
            ->setEmail($email)
            ->changePassword($plainPassword)
            ->setStatus(self::STATUS_USER);

        return $user;
    }

    public function getId(): int | null
    {
        return $this->id;
    }

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

    public function isAdmin(): bool
    {
        return $this->status === self::STATUS_ADMIN;
    }

    public function isUser(): bool
    {
        return $this->status === self::STATUS_USER;
    }

    public function promoteToAdmin(): self
    {
        $this->status = self::STATUS_ADMIN;
        return $this;
    }

    public function demoteToUser(): self
    {
        $this->status = self::STATUS_USER;
        return $this;
    }

    public function canManageUsers(): bool
    {
        return $this->isAdmin();
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): User
    {
        $this->username = $username;
        return $this;
    }

    public function getBirth_date(): ?string
    {
        return $this->birth_date;
    }

    public function setBirth_date(?string $birth_date): User
    {
        $this->birth_date = $birth_date;
        return $this;
    }

    public function getEmail(): string | null
    {
        return $this->email;
    }

    public function setEmail(string | null $email): User | null
    {
        $this->email = $email;
        return $this;
    }

    public function getFirst_name(): ?string
    {
        return $this->first_name;
    }

    public function setFirst_name(?string $first_name): User
    {
        $this->first_name = $first_name;
        return $this;
    }

    public function getLast_name(): ?string
    {
        return $this->last_name;
    }

    public function setLast_name(?string $last_name): User
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * Hydratation / persistance : stocke le hash tel quel (ne re-hash pas).
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Hash un mot de passe en clair et le stocke.
     */
    public function changePassword(string $plainPassword): self
    {
        if (strlen($plainPassword) < 4) {
            throw new DomainException('Le mot de passe doit contenir au moins 4 caractères.');
        }

        $this->password = password_hash($plainPassword, PASSWORD_BCRYPT, ['cost' => 12]);
        return $this;
    }

    public function getHashedPassword(): ?string
    {
        return $this->password;
    }

    public function passwordMatch(?string $plainPwd): bool
    {
        if ($plainPwd === null || $this->password === null || $this->password === '') {
            return false;
        }

        return password_verify($plainPwd, $this->password);
    }

    /**
     * Applique des mises à jour profil avec règles métier (ex. hash du password).
     *
     * @param array<string, mixed> $fields
     */
    public function applyUpdates(array $fields): self
    {
        foreach ($fields as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            match ($key) {
                'username' => $this->setUsername((string) $value),
                'first_name' => $this->setFirst_name((string) $value),
                'last_name' => $this->setLast_name((string) $value),
                'email' => $this->setEmail((string) $value),
                'birth_date' => $this->setBirth_date((string) $value),
                'password' => $this->changePassword((string) $value),
                'status' => $this->setStatus((string) $value),
                default => null,
            };
        }

        return $this;
    }
}
