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

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behatch\Context\RestContext;

trait RestContextTrait
{
    protected RestContext $restContext;

    /**
     * @BeforeScenario
     */
    public function gatherRestContext(BeforeScenarioScope $scope): void
    {
        $this->restContext = $scope->getEnvironment()->getContext(RestContext::class); // @phpstan-ignore-line
    }
}
