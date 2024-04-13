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

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class ParentType
{
    #[ORM\Id]
    #[ORM\Column(type: 'smallint', unique: true)]
    private int $id = 0;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $notes;
}
