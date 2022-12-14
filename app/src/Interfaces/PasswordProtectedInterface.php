<?php

namespace Gladblog\Interfaces;

interface PasswordProtectedInterface
{
    public function getHashedPassword(): ?string;

    public function passwordMatch(?string $plainPwd): bool;
}
