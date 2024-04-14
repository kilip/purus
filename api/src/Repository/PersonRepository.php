<?php

namespace Purus\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    public function store(PersonInterface $person): void
    {
        $this->getEntityManager()->persist($person);
        $this->getEntityManager()->flush();
    }
}
