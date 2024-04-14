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
use Doctrine\Persistence\ManagerRegistry;
use Purus\Contracts\Entity\FamilyInterface;
use Purus\Contracts\Entity\FamilyRepositoryInterface;
use Purus\Entity\Family;
use Purus\Entity\Person;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;

/**
 * @extends ServiceEntityRepository<Family>
 */
#[AsAlias(id: FamilyRepositoryInterface::class)]
class FamilyRepository extends ServiceEntityRepository implements FamilyRepositoryInterface
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

    public function store(FamilyInterface $family): void
    {
        $this->getEntityManager()->persist($family);
        $this->getEntityManager()->flush();
    }
}
