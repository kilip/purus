<?php

namespace Purus\Security\Core;

use Purus\Contracts\Security\UserRepositoryInterface;
use Purus\Entity\User;
use Symfony\Component\Security\Core\User\AttributesBasedUserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final readonly class UserProvider implements AttributesBasedUserProviderInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $users
    )
    {
    }

    /**
     * @param array<string,mixed> $attributes
     */
    public function loadUserByIdentifier(string $identifier, array $attributes = []): UserInterface
    {
        $user = $this->users->findByEmail($identifier);
        if(is_null($user)){
            $user = $this->users->create();
        }

        $user->setEmail($identifier);
        if(isset($attributes['name'])){
            $user->setFullName($attributes['name']);
        }

        $this->users->store($user);

        return $user;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        $this->users->refresh($user);
        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return $class === User::class;
    }

}
