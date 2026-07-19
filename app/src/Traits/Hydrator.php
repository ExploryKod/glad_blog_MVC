<?php

namespace Gladblog\Traits;

trait Hydrator
{
    /**
     * Hydrate l’entité depuis un tableau (ligne SQL).
     * Utilise $hydrationMap si défini : colonne BDD => nom de setter.
     *
     * @param array $data
     * @return void
     */
    public function hydrate(array $data): void
    {
        /** @var array<string, string> $map */
        $map = property_exists($this, 'hydrationMap') ? $this->hydrationMap : [];

        foreach ($data as $key => $value) {
            $method = $map[$key] ?? ('set' . ucfirst((string) $key));
            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }
}
