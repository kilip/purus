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

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $birthday;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $placeBirth;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $death;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $deathPlace;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $deathCause;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $notes;

    #[ORM\Column(type: 'integer')]
    private int $fatherStatus = 0;

    #[ORM\Column(type: 'integer')]
    private int $motherStatus = 0;

    #[ORM\OneToMany(targetEntity: Family::class, mappedBy: 'husband')]
    private Collection $husbandRelations;

    #[ORM\OneToMany(targetEntity: Family::class, mappedBy: 'wife')]
    private Collection $wifeRelations;


    public function getFamilies(): Collection
    {
        if(Constants::GENDER_MALE === $this->gender){
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

    public function getBirthday(): ?\DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getPlaceBirth(): ?string
    {
        return $this->placeBirth;
    }

    public function setPlaceBirth(?string $placeBirth): void
    {
        $this->placeBirth = $placeBirth;
    }

    public function getDeath(): ?\DateTime
    {
        return $this->death;
    }

    public function setDeath(?\DateTime $death): void
    {
        $this->death = $death;
    }

    public function getDeathPlace(): ?string
    {
        return $this->deathPlace;
    }

    public function setDeathPlace(?string $deathPlace): void
    {
        $this->deathPlace = $deathPlace;
    }

    public function getDeathCause(): ?string
    {
        return $this->deathCause;
    }

    public function setDeathCause(?string $deathCause): void
    {
        $this->deathCause = $deathCause;
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

    public function getFatherStatus(): int
    {
        return $this->fatherStatus;
    }

    public function setFatherStatus(int $fatherStatus): void
    {
        $this->fatherStatus = $fatherStatus;
    }

    public function getMotherStatus(): int
    {
        return $this->motherStatus;
    }

    public function setMotherStatus(int $motherStatus): void
    {
        $this->motherStatus = $motherStatus;
    }

    public function getGender(): int
    {
        return $this->gender;
    }

    public function setGender(int $gender): void
    {
        $this->gender = $gender;
    }

    public function getHusbandRelations(): Collection
    {
        return $this->husbandRelations;
    }

    public function setHusbandRelations(Collection $husbandRelations): void
    {
        $this->husbandRelations = $husbandRelations;
    }

    public function getWifeRelations(): Collection
    {
        return $this->wifeRelations;
    }

    public function setWifeRelations(Collection $wifeRelations): void
    {
        $this->wifeRelations = $wifeRelations;
    }
}
