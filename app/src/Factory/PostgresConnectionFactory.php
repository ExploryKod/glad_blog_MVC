<?php

namespace Gladblog\Factory;

use Gladblog\Interfaces\PdoConnectionFactory;

/**
 * Concrete Factory — connexion PostgreSQL via PDO.
 */
class PostgresConnectionFactory implements PdoConnectionFactory
{
    private string $host;
    private string $dbName;
    private string $userName;
    private string $password;
    private int $port;

    /**
     * @param string $host
     * @param string $dbName
     * @param string $userName
     * @param string $password
     * @param int $port
     */
    public function __construct(
        string $host = "database",
        string $dbName = "glad_blog",
        string $userName = "root",
        string $password = "password",
        int $port = 5432
    ) {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->userName = $userName;
        $this->password = $password;
        $this->port = $port;
    }

    /**
     * @return \PDO
     */
    public function createConnection(): \PDO
    {
        return new \PDO(
            "pgsql:host={$this->host};port={$this->port};dbname={$this->dbName}",
            $this->userName,
            $this->password,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ]
        );
    }
}
