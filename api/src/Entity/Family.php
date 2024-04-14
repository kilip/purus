<?php

namespace Purus\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ApiResource(mercure: true)]
#[ORM\Entity()]
class Family
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private ?Uuid $id = null;

    #[ORM\ManyToOne(targetEntity: Person::class, inversedBy: 'families')]
    private Person $husband;

    #[ORM\ManyToOne(targetEntity: Person::class, inversedBy: 'families')]
    private Person $wife;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getHusband(): Person
    {
        return $this->husband;
    }

    public function setHusband(Person $husband): void
    {
        $this->husband = $husband;
    }

    public function getWife(): Person
    {
        return $this->wife;
    }

    public function setWife(Person $wife): void
    {
        $this->wife = $wife;
    }
}
