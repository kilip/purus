<?php

/*
 * This file is part of the Purus project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Purus\Contracts\Entity;

use Symfony\Component\Uid\Uuid;

interface PersonInterface
{
    public function getId(): ?Uuid;

    public function getGender(): int;

    public function setGender(int $gender): self;

    public function setFamily(FamilyInterface $family = null): self;
}
