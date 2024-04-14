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

use Purus\Constants;
use Purus\Contracts\Entity\PersonRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(fromTransport: 'async')]
class FamilyHandler
{
    public function __construct(
        private readonly PersonRepositoryInterface $persons
    ) {
    }

    public function __invoke(FamilyMessage $message): void
    {
        $this->fixGender($message);
    }

    private function fixGender(FamilyMessage $message): void
    {
        $persons = $this->persons;
        $husband = $this->persons->findById($message->getHusbandId());
        $wife = $this->persons->findById($message->getWifeId());

        if (Constants::GENDER_MALE !== $husband->getGender()) {
            $husband->setGender(Constants::GENDER_MALE);
            $persons->store($husband);
        }

        if (Constants::GENDER_FEMALE !== $wife->getGender()) {
            $wife->setGender(Constants::GENDER_FEMALE);
            $persons->store($wife);
        }
    }
}
