<?php

namespace Purus\Tests\Functional\Trait;

use Purus\Constants;
use Purus\Contracts\Entity\PersonInterface;
use Purus\Contracts\Entity\PersonRepositoryInterface;

trait PersonTrait
{
    public function createPerson(string $fullname, int $gender = Constants::GENDER_UNKNOWN): PersonInterface
    {
        $persons = $this->getPersons();
        $person = $persons->findByName($fullname);
        if(is_null($person)) {
            $person = $persons->create($fullname);
        }
        $person->setGender($gender);
        $persons->store($person);
        return $person;
    }

    protected function getPersons(): PersonRepositoryInterface
    {
        return $this->getContainer()->get(PersonRepositoryInterface::class);
    }
}
