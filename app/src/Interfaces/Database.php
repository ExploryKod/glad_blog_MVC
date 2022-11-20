<?php
// Passe un contrat : toute class qui implémente cette interface devra ne retourner que un objet PDO
namespace Gladblog\Interfaces;

interface Database
{
    public function getMySqlPDO(): \PDO;
    public function getPostgresPDO(): \PDO;
    public function getMongoPDO(): \PDO;
}