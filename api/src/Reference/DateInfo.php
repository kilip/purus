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

class DateInfo
{
    private ?int $year = null;
    private ?int $month = null;
    private ?int $day = null;
    private ?int $hour = null;
    private ?int $minutes = null;
    private ?int $seconds = null;

    private ?string $text = null;

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): DateInfo
    {
        $this->year = $year;

        return $this;
    }

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function setMonth(?int $month): DateInfo
    {
        $this->month = $month;

        return $this;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(?int $day): DateInfo
    {
        $this->day = $day;

        return $this;
    }

    public function getHour(): ?int
    {
        return $this->hour;
    }

    public function setHour(?int $hour): DateInfo
    {
        $this->hour = $hour;

        return $this;
    }

    public function getMinutes(): ?int
    {
        return $this->minutes;
    }

    public function setMinutes(?int $minutes): DateInfo
    {
        $this->minutes = $minutes;

        return $this;
    }

    public function getSeconds(): ?int
    {
        return $this->seconds;
    }

    public function setSeconds(?int $seconds): DateInfo
    {
        $this->seconds = $seconds;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): DateInfo
    {
        $this->text = $text;

        return $this;
    }
}
