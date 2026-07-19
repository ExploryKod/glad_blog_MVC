<?php

namespace Gladblog\Container;

use Gladblog\Factory\MySqlConnectionFactory;
use Gladblog\Interfaces\PdoConnectionFactory;
use Gladblog\Manager\CommentsManager;
use Gladblog\Manager\PostManager;
use Gladblog\Manager\UserManager;
use Gladblog\Service\Session;

/**
 * Point unique de câblage des dépendances (PDO, Managers, Session).
 * Les controllers reçoivent ce container au lieu d'instancier eux-mêmes les factories.
 */
class AppContainer
{
    private PdoConnectionFactory $database;
    private Session $session;
    private ?PostManager $postManager = null;
    private ?UserManager $userManager = null;
    private ?CommentsManager $commentsManager = null;

    /**
     * @param PdoConnectionFactory|null $database Par défaut : MySQL (MariaDB Docker)
     * @param Session|null $session
     */
    public function __construct(?PdoConnectionFactory $database = null, ?Session $session = null)
    {
        $this->database = $database ?? new MySqlConnectionFactory();
        $this->session = $session ?? new Session();
    }

    /**
     * @return PdoConnectionFactory
     */
    public function database(): PdoConnectionFactory
    {
        return $this->database;
    }

    /**
     * @return Session
     */
    public function session(): Session
    {
        return $this->session;
    }

    /**
     * @return PostManager
     */
    public function posts(): PostManager
    {
        return $this->postManager ??= new PostManager($this->database);
    }

    /**
     * @return UserManager
     */
    public function users(): UserManager
    {
        return $this->userManager ??= new UserManager($this->database);
    }

    /**
     * @return CommentsManager
     */
    public function comments(): CommentsManager
    {
        return $this->commentsManager ??= new CommentsManager($this->database);
    }
}
