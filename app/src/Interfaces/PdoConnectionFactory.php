<?php

namespace Gladblog\Interfaces;

/**
 * Abstract Factory — produit : une connexion PDO (bases relationnelles).
 */
interface PdoConnectionFactory
{
    /**
     * @return \PDO
     */
    public function createConnection(): \PDO;
}
