<?php
// Je décide ici de créer une class abstraite qui donner une méthode servant à se connecter à la bdd  via le bon getter de ma factory
// je ne passe pas directement par ma factory dans mon controller
// BaseManager a pour but de déclencher la méthode (getter) getMySqlPDO de ma factory tout en respectant la même interface (Database)
namespace Gladblog\Manager;

use Gladblog\Interfaces\Database;

abstract class BaseManager
{
    protected \PDO $pdo;

    public function __construct(Database $database)
    {
        $this->pdo = $database->getMySqlPDO();
    }
}