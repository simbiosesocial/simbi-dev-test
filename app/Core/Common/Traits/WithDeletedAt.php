<?php

namespace App\Core\Common\Traits;

use DateTime;

trait WithDeletedAt
{
    /**
     * @var DateTime|null
     */
    public ?DateTime $deletedAt;
}
