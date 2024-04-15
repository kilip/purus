<?php

/*
 * This file is part of the Purus project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Purus\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Purus\Entity\EventType;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $this->loadEventType($manager);
        $manager->flush();
    }

    private function loadEventType(ObjectManager $om): void
    {
        $defaultTypes = [
            'Birth',
            'Death',
            'Baptism',
        ];
        $repo = $om->getRepository(EventType::class);

        foreach ($defaultTypes as $type) {
            $ob = $repo->findOneBy(['name' => $type]);
            if (!$ob instanceof EventType) {
                $ob = new EventType($type);
                $om->persist($ob);
                $om->flush();
            }
        }
    }
}
