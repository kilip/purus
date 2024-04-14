<?php

namespace Purus\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Purus\Entity\Family;
use Purus\Entity\Person;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;

/**
 * @extends ServiceEntityRepository<Family>
 */
class FamilyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Family::class);
    }

    public function create(Person $husband, Person $wife): void
    {
        $family = new Family();
        $family->setHusband($husband);
        $family->setWife($wife);
    }

    public function store(Family $family): void
    {
        $this->getEntityManager()->persist($family);
        $this->getEntityManager()->flush();
    }
}
