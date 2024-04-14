<?php

namespace Purus\Messenger\ORM;

class FamilyMessage
{
    public function __construct(
        private readonly string $familyId,
        private readonly string $husbandId,
        private readonly string $wifeId
    )
    {
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
