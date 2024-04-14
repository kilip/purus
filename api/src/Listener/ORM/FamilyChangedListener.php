<?php

namespace Purus\Listener\ORM;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Persistence\ObjectManager;
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
        private readonly  MessageBusInterface $bus
    )
    {
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
