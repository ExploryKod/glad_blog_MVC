<?php

namespace Gladblog\Factory;

use Gladblog\Interfaces\DocumentConnectionFactory;

/**
 * Concrete Factory — connexion MongoDB (driver natif, pas PDO).
 */
class MongoConnectionFactory implements DocumentConnectionFactory
{
    private string $uri;

    /**
     * @param string $uri
     */
    public function __construct(string $uri = "mongodb://database:27017")
    {
        $this->uri = $uri;
    }

    /**
     * @return \MongoDB\Driver\Manager
     */
    public function createConnection(): object
    {
        if (!extension_loaded('mongodb')) {
            throw new \RuntimeException(
                'MongoDB n\'utilise pas PDO. Installez l\'extension PHP mongodb pour utiliser MongoConnectionFactory.'
            );
        }

        return new \MongoDB\Driver\Manager($this->uri);
    }
}
