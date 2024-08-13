<?php

namespace App\Core\Common\Traits;

use DateTime;

trait WithUpdatedAt
{
    /**
     * @var DateTime|null
     */
    public ?DateTime $updatedAt;
}
