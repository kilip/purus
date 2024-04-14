<?php

namespace Purus\Messenger\ORM;

use Purus\Constants;
use Purus\Contracts\Entity\PersonRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FamilyHandler
{
    public function __construct(
        private readonly PersonRepositoryInterface $persons
    )
    {
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

        if($husband->getGender() !== Constants::GENDER_MALE){
            $husband->setGender(Constants::GENDER_MALE);
            $persons->store($husband);
        }

        if($wife->getGender() !== Constants::GENDER_FEMALE){
            $wife->setGender(Constants::GENDER_FEMALE);
            $persons->store($wife);
        }
    }


}
