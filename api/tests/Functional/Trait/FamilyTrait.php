<?php

/*
 * This file is part of the Purus project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Purus\Tests\Functional\Trait;

use Purus\Contracts\Entity\FamilyInterface;
use Purus\Contracts\Entity\FamilyRepositoryInterface;
use Purus\Contracts\Entity\PersonInterface;

trait FamilyTrait
{
    public function createFamily(PersonInterface $husband, PersonInterface $wife): FamilyInterface
    {
        $families = $this->getFamilies();
        $family = $families->create($husband, $wife);
        $families->store($family);

        return $family;
    }

    public function getFamilies(): FamilyRepositoryInterface
    {
        return $this->getContainer()->get(FamilyRepositoryInterface::class);
    }
}
