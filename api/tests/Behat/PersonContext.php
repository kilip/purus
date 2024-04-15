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
use Behat\Gherkin\Node\PyStringNode;
use Purus\Contracts\Entity\PersonInterface;
use Purus\Contracts\Entity\PersonRepositoryInterface;
use Purus\Entity\Person;

class PersonContext implements Context
{
    use RestContextTrait;

    public function __construct(
        private PersonRepositoryInterface $persons
    ) {
    }

    /**
     * @Given I don't have a person with name :fullname
     */
    public function iDonTHavePersonWithName(string $fullname): void
    {
        $person = $this->persons->findByName($fullname);

        if ($person instanceof PersonInterface) {
            $this->persons->remove($person);
        }
    }

    /**
     * @Given I have a person with name :fullname
     */
    public function iHavePersonWithName(string $fullname): void
    {
        $person = $this->persons->findByName($fullname);

        if (!$person instanceof PersonInterface) {
            $person = new Person();
            $person->setFullname($fullname);
            $this->persons->store($person);
        }
    }

    /**
     * @When I send a :method request for :fullname
     * @When I send a :method request for :fullname with body:
     */
    public function iSendARequestWithBody(string $method, string $fullname, PyStringNode $body = null): void
    {
        $person = $this->persons->findByName($fullname);
        $url = '/people/'.$person->getId();

        if ('PATCH' == $method) {
            $this->restContext->iAddHeaderEqualTo('Content-Type', 'application/merge-patch+json');
        }
        $this->restContext->iSendARequestTo($method, $url, $body);
    }
}
