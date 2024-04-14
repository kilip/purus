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
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Purus\Contracts\Entity\FamilyRepositoryInterface;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Delete(),
    ],
    mercure: true
)]
#[ORM\Entity(repositoryClass: FamilyRepositoryInterface::class)]
class Family
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private ?Uuid $id = null;

    #[ORM\ManyToOne(targetEntity: Person::class, inversedBy: 'husbandRelations')]
    private Person $husband;

    #[ORM\ManyToOne(targetEntity: Person::class, inversedBy: 'wifeRelations')]
    private Person $wife;

    /**
     * @var Collection<int,Person>
     */
    #[ORM\OneToMany(targetEntity: Person::class, mappedBy: 'family')]
    private Collection $children;

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

    /**
     * @return Collection<int,Person>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @param Collection<int,Person> $children
     */
    public function setChildren(Collection $children): void
    {
        $this->children = $children;
    }
}
