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
use Purus\Contracts\Entity\FamilyInterface;
use Purus\Contracts\Entity\PersonInterface;
use Purus\Repository\PersonRepository;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ApiResource(mercure: true)]
#[ORM\Entity(repositoryClass: PersonRepository::class)]
#[ORM\Index(name: 'ix_person_name', columns: ['fullname'])]
#[ORM\Index(name: 'ix_person_family', columns: ['family_id'])]
class Person implements PersonInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private ?Uuid $id = null;

    #[ORM\Column(type: 'string')]
    private string $fullname;

    #[ORM\Column(type: 'smallint')]
    private int $gender = 0;

    /**
     * @var string[] $nickNames
     */
    #[ORM\Column(type: 'json', nullable: true)]
    private array $nickNames;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $notes;

    #[ORM\ManyToOne(targetEntity: Family::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'family_id', onDelete: 'SET NULL')]
    private ?FamilyInterface $family = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getFullname(): string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): Person
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getGender(): int
    {
        return $this->gender;
    }

    public function setGender(int $gender): Person
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getNickNames(): array
    {
        return $this->nickNames;
    }

    /**
     * @param array<int,string> $nickNames
     */
    public function setNickNames(array $nickNames): Person
    {
        $this->nickNames = $nickNames;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): Person
    {
        $this->notes = $notes;

        return $this;
    }

    public function getFamily(): ?FamilyInterface
    {
        return $this->family;
    }

    public function setFamily(FamilyInterface $family = null): Person
    {
        $this->family = $family;

        return $this;
    }
}
