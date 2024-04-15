<?php

/*
 * This file is part of the Purus project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Purus\Tests\Functional\Entity;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Doctrine\Persistence\ManagerRegistry;
use Purus\Entity\Event;
use Purus\Entity\EventParticipant;
use Purus\Entity\EventType;
use Purus\Reference\Date;
use Purus\Tests\Functional\Trait\PersonTrait;
use Zenstruck\Foundry\Test\ResetDatabase;

class EventTest extends ApiTestCase
{
    use PersonTrait;
    use ResetDatabase;

    public function testCreate(): void
    {
        $client = static::createClient();

        $em = $this->getContainer()->get(ManagerRegistry::class)->getManager();
        $repo = $em->getRepository(EventType::class);
        $birth = $repo->findOneBy(['name' => 'Birth']);
        if (!$birth instanceof EventType) {
            $birth = new EventType('Birth');
            $em->persist($birth);
            $em->flush();
        }

        $this->assertNotNull($birth);
        $person = $this->createPerson('Zeus');
        $event = new Event();
        $event->setType($birth);

        $date = new Date();
        $date->getStart()
            ->setYear(1980)
            ->setMonth(7)
            ->setDay(21);

        $participant = (new EventParticipant())
            ->setEvent($event)
            ->setPerson($person)
        ;
        $event->setDate($date);
        $event->getParticipants()->add($participant);

        $em->persist($event);
        $em->flush();

        $this->assertNotNull($event->getId());
    }
}
