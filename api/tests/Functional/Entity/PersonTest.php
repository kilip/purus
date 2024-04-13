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
use Purus\Factory\PersonFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

/**
 * @covers \Purus\Entity\Person
 */
class PersonTest extends ApiTestCase
{
    use ResetDatabase;
    use Factories;

    public function testGetCollection(): void
    {
        PersonFactory::createMany(10);

        $response = static::createClient()->request('GET', '/books');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/Person',
            '@id' => '/people',
            '@type' => 'hydra:Collection',
            'hydra:totalItems' => 10,
            'hydra:view' => [
                '@id' => '/people?page=1',
                '@type' => 'hydra:PartialCollectionView',
                'hydra:first' => '/people?page=1',
                'hydra:last' => '/people?page=4',
                'hydra:next' => '/people?page=2',
            ],
        ]);
    }
}
