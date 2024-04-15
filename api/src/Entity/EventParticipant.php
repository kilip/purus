<?php

/*
 * This file is part of the Purus project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Purus\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Purus\Contracts\Entity\PersonInterface;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ApiResource]
#[ORM\Entity]
class EventParticipant
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private ?Uuid $id = null;

    #[ORM\ManyToOne(targetEntity: PersonInterface::class)]
    private PersonInterface $person;

    #[ORM\ManyToOne(targetEntity: Event::class, inversedBy: 'participants')]
    private Event $event;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getPerson(): PersonInterface
    {
        return $this->person;
    }

    public function setPerson(PersonInterface $person): EventParticipant
    {
        $this->person = $person;

        return $this;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function setEvent(Event $event): EventParticipant
    {
        $this->event = $event;

        return $this;
    }
}
