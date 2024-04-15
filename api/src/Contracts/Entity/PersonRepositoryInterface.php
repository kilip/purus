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

interface PersonRepositoryInterface
{
    public function findById(string $id): ?PersonInterface;

    public function create(string $fullname): PersonInterface;

    public function store(PersonInterface $person): void;

    public function findByName(string $fullname): ?PersonInterface;

    public function remove(PersonInterface $person): void;
}
