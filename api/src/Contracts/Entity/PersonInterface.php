<?php

/*
 * This file is part of the Purus project.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Purus\Contracts\Entity;

interface PersonInterface
{
    public const PARENT_TYPE_BIOLOGICAL = 1;

    public const PARENT_TYPE_STEP_CHILD = 2;

    public const PARENT_TYPE_ADOPTED = 3;
}
