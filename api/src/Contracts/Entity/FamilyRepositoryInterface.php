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

interface FamilyRepositoryInterface
{
    public function create(PersonInterface $husband, PersonInterface $wife): FamilyInterface;

    public function store(FamilyInterface $family): void;

    public function addChildren(FamilyInterface $family, PersonInterface $person): FamilyInterface;

    public function removeChildren(FamilyInterface $family, PersonInterface $person): FamilyInterface;
}
