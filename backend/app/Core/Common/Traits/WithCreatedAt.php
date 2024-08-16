<?php

namespace App\Core\Common\Traits;

use DateTime;

trait WithCreatedAt
{
    /**
     * @var DateTime|null
     */
    public ?DateTime $createdAt;
}
