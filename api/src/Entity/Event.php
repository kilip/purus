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
use Purus\Reference\Date;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ApiResource]
#[ORM\Entity()]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private ?Uuid $id = null;

    #[ORM\ManyToOne(targetEntity: EventType::class, inversedBy: 'events')]
    private EventType $type;

    #[ORM\Column(type: 'json_document', options: ['jsonb' => true])]
    private Date $date;

    #[ORM\Column(type: 'datetime')]
    /**
     * Only for sorting and filtering purposes.
     */
    private \DateTime $dateValue;

    #[ORM\ManyToOne(targetEntity: Place::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Place $place = null;

    /**
     * @var Collection<int, EventParticipant>
     */
    #[ORM\OneToMany(targetEntity: EventParticipant::class, mappedBy: 'event', cascade: ['persist', 'remove'])]
    private Collection $participants;

    public function __construct()
    {
        $this->participants = new ArrayCollection([]);
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getType(): EventType
    {
        return $this->type;
    }

    public function setType(EventType $type): Event
    {
        $this->type = $type;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(Place $place): Event
    {
        $this->place = $place;

        return $this;
    }

    public function getDateValue(): \DateTime
    {
        return $this->dateValue;
    }

    public function setDateValue(\DateTime $dateValue): Event
    {
        $this->dateValue = $dateValue;

        return $this;
    }

    public function getDate(): Date
    {
        return $this->date;
    }

    public function setDate(Date $date): Event
    {
        $this->date = $date;
        $this->setDateValue($date->getValue());

        return $this;
    }

    /**
     * @return Collection<int, EventParticipant>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    /**
     * @param Collection<int, EventParticipant> $participants
     */
    public function setParticipants(Collection $participants): Event
    {
        $this->participants = $participants;

        return $this;
    }
}
