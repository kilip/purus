<?php

/*
 * This file is part of the Purus project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Purus\Tests\Messenger\ORM;

use PHPUnit\Framework\TestCase;
use Purus\Constants;
use Purus\Contracts\Entity\PersonInterface;
use Purus\Contracts\Entity\PersonRepositoryInterface;
use Purus\Messenger\ORM\FamilyHandler;
use Purus\Messenger\ORM\FamilyMessage;

class FamilyHandlerTest extends TestCase
{
    public function testInvoke(): void
    {
        $message = new FamilyMessage('family', 'husband', 'wife');
        $persons = $this->createMock(PersonRepositoryInterface::class);
        $person = $this->createMock(PersonInterface::class);
        $handler = new FamilyHandler($persons);

        $persons->expects($this->exactly(2))
            ->method('findById')
            ->willReturn($person);

        $person->expects($this->exactly(2))
            ->method('getGender')
            ->willReturn(Constants::GENDER_UNKNOWN);

        $person->expects($this->exactly(2))
            ->method('setGender');

        $persons->expects($this->exactly(2))
            ->method('store')
            ->with($person);

        $handler($message);
    }
}
