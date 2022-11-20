<?php
// Permet de se saisir des méthodes (getters) qui vont permettre de démarrer une connexion de database via leurs paramètres (voir constructeur)
// Ne retourne qu'un objet PDO car ça implémente Database (interface)
namespace Gladblog\Factory;

use Gladblog\Interfaces\Database;

class PDOFactory implements Database
{
    private string $host;
    private string $dbName;
    private string $userName;
    private string $password;

    public function __construct(string $host = "database", string $dbName = "glad_blog", string $userName = "root", string $password = "password")
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->userName = $userName;
        $this->password = $password;
    }

    public function getMySqlPDO(): \PDO
    {
        return new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->userName, $this->password);
    }

    public function getPostgresPDO(): \PDO
    {
        return new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->userName, $this->password);
    }

    public function getMongoPDO(): \PDO
    {
        return new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->userName, $this->password);
    }
}
