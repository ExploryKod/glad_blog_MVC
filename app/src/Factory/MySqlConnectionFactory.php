<?php

namespace Gladblog\Factory;

use Gladblog\Interfaces\PdoConnectionFactory;

/**
 * Concrete Factory — connexion MySQL / MariaDB via PDO.
 */
class MySqlConnectionFactory implements PdoConnectionFactory
{
    private string $host;
    private string $dbName;
    private string $userName;
    private string $password;

    /**
     * @param string $host
     * @param string $dbName
     * @param string $userName
     * @param string $password
     */
    public function __construct(
        string $host = "database",
        string $dbName = "glad_blog",
        string $userName = "root",
        string $password = "password"
    ) {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->userName = $userName;
        $this->password = $password;
    }

    /**
     * @return \PDO
     */
    public function createConnection(): \PDO
    {
        return new \PDO(
            "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4",
            $this->userName,
            $this->password,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ]
        );
    }
}
