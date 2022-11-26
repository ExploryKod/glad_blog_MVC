<?php
namespace Gladblog\Controllers;

class SessionController extends AbstractController {

    private string $username;
    private bool $started = false;

    public function __construct()
    {

    }
    /**
     * @return bool
     */
    public function isStarted(): bool
    {
        return $this->started;
    }

    /**
     * @param bool $started
     */
    public function setStarted(bool $started): void
    {
        $this->started = $started;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $_SESSION['user'] = $username;
    }

    public function sessionStart():void {
        session_start();
        $this->started = true;
    }

    public function sessionDestroy():void {
        session_destroy();
        $this->started = false;
    }

}
