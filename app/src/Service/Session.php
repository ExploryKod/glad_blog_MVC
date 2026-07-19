<?php

namespace Gladblog\Service;

use Gladblog\Entity\User;

class Session
{
    /**
     * Démarre la session PHP si elle n’est pas déjà active.
     *
     * @return void
     */
    public function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @return int|null
     */
    public function userId(): ?int
    {
        $id = $_SESSION['userId'] ?? null;
        return $id !== null ? (int) $id : null;
    }

    /**
     * @return string|null
     */
    public function username(): ?string
    {
        return $_SESSION['user'] ?? null;
    }

    /**
     * @return string|null
     */
    public function status(): ?string
    {
        return $_SESSION['userStatus'] ?? null;
    }

    /**
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        return $this->userId() !== null;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->status() === User::STATUS_ADMIN;
    }

    /**
     * Enregistre l’utilisateur connecté en session.
     *
     * @param User $user
     * @return void
     */
    public function login(User $user): void
    {
        $this->start();
        $_SESSION['user'] = $user->getUsername();
        $_SESSION['userId'] = $user->getId();
        $_SESSION['userStatus'] = $user->getStatus();
    }

    /**
     * Détruit la session courante.
     *
     * @return void
     */
    public function destroy(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
}
