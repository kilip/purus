<?php

/*
 * This file is part of the Purus project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Purus\Listener\ORM;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Purus\Entity\Family;
use Purus\Messenger\ORM\FamilyMessage;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsEntityListener(
    event: Events::postPersist,
    method: 'postPersist',
    entity: Family::class
)]
class FamilyChangedListener
{
    public function __construct(
        private readonly MessageBusInterface $bus
    ) {
    }

    public function postPersist(Family $family): void
    {
        $message = new FamilyMessage(
            $family->getId(),
            $family->getHusband()->getId(),
            $family->getWife()->getId()
        );
        $this->bus->dispatch($message);
    }
}
