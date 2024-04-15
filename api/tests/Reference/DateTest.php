<?php

/*
 * This file is part of the Purus project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Purus\Tests\Reference;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Purus\Reference\Date;

class DateTest extends TestCase
{
    public function testExactWithRegular(): void
    {
        $date = new Date();
        $date
            ->getStart()
            ->setYear(1900)
            ->setMonth(12)
            ->setDay(1)
        ;
        $expected = Carbon::create(1900, 12, 1);
        $this->assertEquals($expected, $date->getValue());
    }
}
