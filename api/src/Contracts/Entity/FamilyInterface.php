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

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

interface FamilyInterface
{
    public function getId(): ?Uuid;

    /**
     * @return Collection<int,PersonInterface>
     */
    public function getChildren(): Collection;
}
