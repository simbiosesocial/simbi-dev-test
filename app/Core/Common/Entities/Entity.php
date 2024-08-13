<?php

namespace App\Core\Common\Entities;

use Ramsey\Uuid\Uuid;

abstract class Entity
{
    /**
     * @var string|null
     */
    public ?string $id;

    public function __construct(?string $id)
    {
        $this->id = empty($id) ? Uuid::uuid4() : $id;
    }
}
