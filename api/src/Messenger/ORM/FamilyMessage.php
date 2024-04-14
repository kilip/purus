<?php

/*
 * This file is part of the Purus project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Purus\Messenger\ORM;

class FamilyMessage
{
    public function __construct(
        private readonly string $familyId,
        private readonly string $husbandId,
        private readonly string $wifeId
    ) {
    }

    public function getFamilyId(): string
    {
        return $this->familyId;
    }

    public function getHusbandId(): string
    {
        return $this->husbandId;
    }

    public function getWifeId(): string
    {
        return $this->wifeId;
    }
}
