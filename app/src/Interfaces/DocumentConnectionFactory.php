<?php

namespace Gladblog\Interfaces;

/**
 * Abstract Factory — produit : un client document (MongoDB, etc.).
 * Hors famille PDO : MongoDB n’utilise pas PDO.
 */
interface DocumentConnectionFactory
{
    /**
     * @return object Client / manager de la base document
     */
    public function createConnection(): object;
}
