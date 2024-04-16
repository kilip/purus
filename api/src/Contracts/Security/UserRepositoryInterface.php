<?php

namespace Purus\Contracts\Security;

use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

interface UserRepositoryInterface
{

    public function refresh(SymfonyUserInterface $user): void;

    public function findByEmail(string $identifier): ?UserInterface;

    public function create(): UserInterface;

    public function store(UserInterface $user): void;
}
