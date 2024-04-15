<?php

/*
 * This file is part of the Purus project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Purus\Reference;

use Carbon\Carbon;

class Date
{
    public const QualityExact = 1;
    public const QualityEstimated = 2;
    public const QualityCalculated = 3;
    public const TypeRegular = 1;
    public const TypeBefore = 2;
    public const TypeAfter = 3;
    public const TypeAbout = 4;
    public const TypeRange = 5;
    public const TypeFrom = 6;
    public const TypeTo = 7;
    public const TypeSpan = 8;

    public function __construct(
        private int $quality = self::QualityExact,
        private int $type = self::TypeRegular,
        private DateInfo $start = new DateInfo(),
        private DateInfo $end = new DateInfo()
    ) {
    }

    /**
     * TODO: provide implementation for other date type.
     */
    public function getValue(): \DateTime
    {
        $start = $this->getStart();

        return Carbon::create($start->getYear(), $start->getMonth(), $start->getDay())->toDateTime();
    }

    public function getQuality(): int
    {
        return $this->quality;
    }

    public function setQuality(int $quality): Date
    {
        $this->quality = $quality;

        return $this;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): Date
    {
        $this->type = $type;

        return $this;
    }

    public function getStart(): DateInfo
    {
        return $this->start;
    }

    public function setStart(DateInfo $start): Date
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): DateInfo
    {
        return $this->end;
    }

    public function setEnd(DateInfo $end): Date
    {
        $this->end = $end;

        return $this;
    }
}
