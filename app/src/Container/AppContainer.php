<?php

namespace Gladblog\Container;

use Gladblog\Factory\PDOFactory;
use Gladblog\Interfaces\Database;
use Gladblog\Manager\CommentsManager;
use Gladblog\Manager\PostManager;
use Gladblog\Manager\UserManager;
use Gladblog\Service\Session;

/**
 * Point unique de câblage des dépendances (PDO, Managers, Session).
 * Les controllers reçoivent ce container au lieu d'instancier eux-mêmes PDOFactory.
 */
class AppContainer
{
    private Database $database;
    private Session $session;
    private ?PostManager $postManager = null;
    private ?UserManager $userManager = null;
    private ?CommentsManager $commentsManager = null;

    public function __construct(?Database $database = null, ?Session $session = null)
    {
        $this->database = $database ?? new PDOFactory();
        $this->session = $session ?? new Session();
    }

    public function database(): Database
    {
        return $this->database;
    }

    public function session(): Session
    {
        return $this->session;
    }

    public function posts(): PostManager
    {
        return $this->postManager ??= new PostManager($this->database);
    }

    public function users(): UserManager
    {
        return $this->userManager ??= new UserManager($this->database);
    }

    public function comments(): CommentsManager
    {
        return $this->commentsManager ??= new CommentsManager($this->database);
    }
}
