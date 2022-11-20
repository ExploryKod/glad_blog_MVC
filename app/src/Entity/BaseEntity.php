<?php
// Le traits hydrator permet de itérer directement sur tout les setter et getter qui seront dans le param de cette class

namespace Gladblog\Entity;

use Gladblog\Traits\Hydrator;

abstract class BaseEntity
{
    use Hydrator;

    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }
}