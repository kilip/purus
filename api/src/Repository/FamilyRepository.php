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
use Purus\Contracts\Entity\PersonInterface;
use Purus\Entity\Family;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;

/**
 * @extends ServiceEntityRepository<Family>
 */
#[AsAlias(FamilyRepositoryInterface::class, true)]
class FamilyRepository extends ServiceEntityRepository implements FamilyRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Family::class);
    }

    public function create(PersonInterface $husband, PersonInterface $wife): FamilyInterface
    {
        $family = new Family();
        $family->setHusband($husband);
        $family->setWife($wife);

        return $family;
    }

    public function store(FamilyInterface $family): void
    {
        $this->getEntityManager()->persist($family);
        $this->getEntityManager()->flush();
    }

    public function addChildren(FamilyInterface $family, PersonInterface $person): FamilyInterface
    {
        if(!$family->getChildren()->contains($person)) {
            $family->getChildren()->add($person);
            $person->setFamily($family);

            $this->store($family);
            $this->getEntityManager()->persist($person);
            $this->getEntityManager()->flush();
        }

        $this->getEntityManager()->refresh($family);
        $this->getEntityManager()->refresh($person);

        return $family;
    }

    public function removeChildren(FamilyInterface $family, PersonInterface $person): FamilyInterface
    {
        if($family->getChildren()->contains($person)) {
            $family->getChildren()->removeElement($person);
            $this->store($family);

            $person->setFamily(null);
            $this->getEntityManager()->persist($person);
            $this->getEntityManager()->flush();
        }

        return $family;
    }
}
