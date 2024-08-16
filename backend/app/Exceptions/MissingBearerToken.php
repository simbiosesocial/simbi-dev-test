<?php

namespace App\Exceptions;

use Exception;

final class MissingBearerToken extends Exception
{
    protected $message = 'Bearer token is missing!';
}
