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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Purus\Contracts\Entity\FamilyInterface;
use Purus\Contracts\Entity\PersonInterface;
use Purus\Repository\FamilyRepository;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(),
        new Get(),
        new Put(),
        new Delete(),
    ],
    mercure: true
)]
#[ORM\Entity(repositoryClass: FamilyRepository::class)]
class Family implements FamilyInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private ?Uuid $id = null;

    #[ORM\ManyToOne(targetEntity: PersonInterface::class)]
    private PersonInterface $husband;

    #[ORM\ManyToOne(targetEntity: PersonInterface::class)]
    private PersonInterface $wife;

    /**
     * @var Collection<int,PersonInterface>
     */
    #[ORM\OneToMany(targetEntity: Person::class, mappedBy: 'family', orphanRemoval: false)]
    private Collection $children;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getHusband(): PersonInterface
    {
        return $this->husband;
    }

    public function setHusband(PersonInterface $husband): void
    {
        $this->husband = $husband;
    }

    public function getWife(): PersonInterface
    {
        return $this->wife;
    }

    public function setWife(PersonInterface $wife): void
    {
        $this->wife = $wife;
    }

    /**
     * @return Collection<int,PersonInterface>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @param Collection<int,PersonInterface> $children
     */
    public function setChildren(Collection $children): void
    {
        $this->children = $children;
    }
}
