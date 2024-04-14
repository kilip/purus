<?php

/*
 * This file is part of the Purus project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Purus\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\LockMode;
use Doctrine\Persistence\ManagerRegistry;
use Purus\Contracts\Entity\PersonInterface;
use Purus\Contracts\Entity\PersonRepositoryInterface;
use Purus\Entity\Person;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;

/**
 * @extends ServiceEntityRepository<Person>
 */
#[AsAlias(PersonRepositoryInterface::class)]
class PersonRepository extends ServiceEntityRepository implements PersonRepositoryInterface
{
    public function __construct(ManagerRegistry $em)
    {
        parent::__construct($em, Person::class);
    }

    public function findById(string $id): ?PersonInterface
    {
        return $this->find($id);
    }

    public function findByName(string $fullname): ?PersonInterface
    {
        return $this->findOneBy(['fullname' => $fullname]);
    }

    public function create(string $fullname): PersonInterface
    {
        return (new Person())->setFullname($fullname);
    }

    public function store(PersonInterface $person): void
    {
        $this->getEntityManager()->persist($person);
        $this->getEntityManager()->flush();
    }
}
