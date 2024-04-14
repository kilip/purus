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

use Purus\Constants;
use Purus\Contracts\Entity\PersonInterface;
use Purus\Contracts\Entity\PersonRepositoryInterface;

trait PersonTrait
{
    public function createPerson(string $fullname, int $gender = Constants::GENDER_UNKNOWN): PersonInterface
    {
        $persons = $this->getPersons();
        $person = $persons->findByName($fullname);
        if (is_null($person)) {
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
