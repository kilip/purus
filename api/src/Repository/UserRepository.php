<?php

namespace Purus\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Purus\Contracts\Security\UserInterface;
use Purus\Contracts\Security\UserRepositoryInterface;
use Purus\Entity\User;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
#[AsAlias(id: UserRepositoryInterface::class)]
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function refresh(SymfonyUserInterface $user): void
    {
        // TODO: Implement refresh() method.
    }

    public function findByEmail(string $identifier): ?UserInterface
    {
        // TODO: Implement findByEmail() method.
    }

    public function create(): UserInterface
    {
        // TODO: Implement create() method.
    }

    public function store(UserInterface $user): void
    {
        // TODO: Implement store() method.
    }

}
