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
use Purus\Tests\Functional\Trait\FamilyTrait;
use Purus\Tests\Functional\Trait\PersonTrait;
use Symfony\Component\HttpFoundation\Request;
use Zenstruck\Foundry\Test\ResetDatabase;

/**
 * @covers \Purus\Entity\Family
 * @covers \Purus\Repository\FamilyRepository
 * @covers \Purus\Controller\Family\UpdateChildren
 */
class FamilyTest extends ApiTestCase
{
    use ResetDatabase;
    use PersonTrait;
    use FamilyTrait;

    public function testCreate(): void
    {
        $client = static::createClient();

        $husband = json_decode($client->request('POST', '/people', [
            'json' => [
                'fullname' => 'Zeus',
                'gender' => 1,
            ],
        ])->getContent(), true);

        $wife = json_decode($client->request('POST', '/people', [
            'json' => [
                'fullname' => 'Hera',
                'gender' => 2,
            ],
        ])->getContent(), true);

        $client->request('POST', 'families', [
            'json' => [
                'husband' => $husband['@id'],
                'wife' => $wife['@id'],
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(201);

        $this->assertJsonContains([
            '@context' => '/contexts/Family',
            '@type' => 'Family',
        ]);
    }

    public function testAddChildren(): void
    {
        $client = static::createClient();

        $husband = $this->createPerson('Zeus');
        $wife = $this->createPerson('Hera');
        $child = $this->createPerson('Ares');
        $family = $this->createFamily($husband, $wife);

        $this->assertFalse($family->getChildren()->contains($child));

        $client->request('PATCH', '/people/'.$child->getId(), [
            'json' => [
                'family' => '/families/'.$family->getId(),
            ],
            'headers' => [
                'content-type' => 'application/merge-patch+json',
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            '@context' => '/contexts/Person',
            '@type' => 'Person',
            'family' => '/families/'.$family->getId(),
        ]);
    }

    public function testRemoveChildren(): void
    {
        $client = static::createClient();

        $husband = $this->createPerson('Zeus');
        $wife = $this->createPerson('Hera');
        $child = $this->createPerson('Ares');
        $family = $this->createFamily($husband, $wife);
        $this->getFamilies()->addChildren($family, $child);

        $this->assertTrue($family->getChildren()->contains($child));

        $url = sprintf('/people/%s', $child->getId());
        $client->request(Request::METHOD_DELETE, $url, [
            'json' => [
                'family' => null,
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(204);
        $this->assertFalse($family->getChildren()->contains($child));
    }
}
