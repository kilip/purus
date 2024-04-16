<?php

namespace Purus\Contracts\Security;

use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;

interface UserInterface extends BaseUserInterface
{
    public function setEmail(string $email): self;

    public function setFullName(string $fullName): self;
}
