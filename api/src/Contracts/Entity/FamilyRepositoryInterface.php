<?php

namespace Purus\Contracts\Entity;

interface FamilyRepositoryInterface
{
    public function store(FamilyInterface $family): void;
}
