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
use Purus\Contracts\Entity\EventTypeInterface;
use Purus\Contracts\Entity\EventTypeRepositoryInterface;
use Purus\Entity\EventType;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;

/**
 * @extends ServiceEntityRepository<EventType>
 */
#[AsAlias(id: EventTypeRepositoryInterface::class)]
class EventTypeRepository extends ServiceEntityRepository implements EventTypeRepositoryInterface
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, EventType::class);
    }

    public function create(string $type): EventTypeInterface
    {
        return new EventType($type);
    }

    public function findByName(string $type): ?EventTypeInterface
    {
        return $this->findONeBy(['name' => $type]);
    }

    public function store(EventTypeInterface $eventType): void
    {
        $this->getEntityManager()->persist($eventType);
        $this->getEntityManager()->flush();
    }
}
