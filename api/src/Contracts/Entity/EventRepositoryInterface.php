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

interface EventRepositoryInterface
{
    public function create(): EventInterface;

    public function store(EventInterface $event): EventInterface;
}
