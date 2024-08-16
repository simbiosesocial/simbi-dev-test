<?php

namespace App\Core\Common\ValueObjects;

interface ValueObject
{
    public function validate(): void;
}
