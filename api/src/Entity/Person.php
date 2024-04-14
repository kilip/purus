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
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Purus\Constants;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ApiResource(mercure: true)]
#[ORM\Entity]
#[ORM\Index(name: 'ix_person_name', columns: ['fullname'])]
#[ORM\Index(name: 'ix_person_family', columns: ['family_id'])]
class Person
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
     * @var array<int,string>
     */
    #[ORM\Column(type: 'json')]
    private array $nickNames = [];

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $notes;

    /**
     * @var Collection<int,Family>
     */
    #[ORM\OneToMany(targetEntity: Family::class, mappedBy: 'husband')]
    private Collection $husbandRelations;

    /**
     * @var Collection<int,Family>
     */
    #[ORM\OneToMany(targetEntity: Family::class, mappedBy: 'wife')]
    private Collection $wifeRelations;

    #[ORM\ManyToOne(targetEntity: Family::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'family_id')]
    private Family $family;

    /**
     * @return Collection<int,Family>
     */
    public function getMarriages(): Collection
    {
        if (Constants::GENDER_MALE === $this->gender) {
            return $this->husbandRelations;
        }

        return $this->wifeRelations;
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getFullname(): string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): void
    {
        $this->fullname = $fullname;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    }

    /**
     * @return array<int,string>
     */
    public function getNickNames(): array
    {
        return $this->nickNames;
    }

    /**
     * @param array<int,string> $nickNames
     */
    public function setNickNames(array $nickNames): void
    {
        $this->nickNames = $nickNames;
    }

    public function getGender(): int
    {
        return $this->gender;
    }

    public function setGender(int $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return Collection<int,Family>
     */
    public function getHusbandRelations(): Collection
    {
        return $this->husbandRelations;
    }

    /**
     * @param Collection<int,Family> $husbandRelations
     */
    public function setHusbandRelations(Collection $husbandRelations): void
    {
        $this->husbandRelations = $husbandRelations;
    }

    /**
     * @return Collection<int,Family>
     */
    public function getWifeRelations(): Collection
    {
        return $this->wifeRelations;
    }

    /**
     * @param Collection<int,Family> $wifeRelations
     */
    public function setWifeRelations(Collection $wifeRelations): void
    {
        $this->wifeRelations = $wifeRelations;
    }

    public function getFamily(): Family
    {
        return $this->family;
    }

    public function setFamily(Family $family): void
    {
        $this->family = $family;
    }
}
