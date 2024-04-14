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
use Purus\Constants;
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

        static::createClient()->request('GET', '/people');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/Person',
            '@id' => '/people',
            '@type' => 'hydra:Collection',
            'hydra:totalItems' => 10,
        ]);
    }

    public function testCreatePerson(): void
    {
        static::createClient()->request('POST', '/people', ['json' => [
            'fullname' => $fullname = 'Anthonius Munthi',
            'gender' => Constants::GENDER_MALE,
            'nickNames' => $nicknames = ['toni'],
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/contexts/Person',
            '@type' => 'Person',
            'fullname' => $fullname,
            'gender' => 1,
            'nickNames' => $nicknames,
        ]);
    }
}
