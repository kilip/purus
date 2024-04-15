<?php

/*
 * This file is part of the Purus project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Purus\Tests\Behat;

use Behat\Behat\Context\Context;
use Purus\Contracts\Entity\EventRepositoryInterface;
use Purus\Contracts\Entity\EventTypeInterface;
use Purus\Contracts\Entity\EventTypeRepositoryInterface;

class EventContext implements Context
{
    use RestContextTrait;

    public function __construct(
        private readonly EventTypeRepositoryInterface $eventTypes
    ) {
    }

    /**
     * @Given I have :type event type
     */
    public function iHaveEventType(string $type): void
    {
        $eventType = $this->eventTypes->findByName($type);

        if (!$eventType instanceof EventTypeInterface) {
            $eventType = $this->eventTypes->create($type);
            $this->eventTypes->store($eventType);
        }
    }
}
