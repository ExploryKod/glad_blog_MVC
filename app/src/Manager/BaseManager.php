<?php
// BaseManager obtient une connexion PDO via l’Abstract Factory (PdoConnectionFactory).
namespace Gladblog\Manager;

use Gladblog\Interfaces\PdoConnectionFactory;

abstract class BaseManager
{
    protected \PDO $pdo;

    /**
     * @param PdoConnectionFactory $database Factory SQL (MySQL, Postgres, …)
     */
    public function __construct(PdoConnectionFactory $database)
    {
        $this->pdo = $database->createConnection();
    }
}
