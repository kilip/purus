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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Purus\Contracts\Entity\EventTypeInterface;
use Purus\Repository\EventTypeRepository;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ApiResource]
#[ORM\Entity(repositoryClass: EventTypeRepository::class)]
class EventType implements EventTypeInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private ?Uuid $id = null;

    /**
     * @param Collection<int, Event> $events
     */
    public function __construct(
        #[ORM\Column(type: 'string')]
        private string $name,

        #[ORM\OneToMany(targetEntity: Event::class, mappedBy: 'type')]
        private Collection $events = new ArrayCollection([])
    ) {
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): EventType
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int,Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    /**
     * @param Collection<int,Event> $events
     */
    public function setEvents(Collection $events): EventType
    {
        $this->events = $events;

        return $this;
    }
}
