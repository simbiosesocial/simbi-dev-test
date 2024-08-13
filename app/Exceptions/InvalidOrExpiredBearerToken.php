<?php

namespace App\Exceptions;

use Exception;

final class InvalidOrExpiredBearerToken extends Exception
{
    protected $message = 'Bearer token is invalid or expired!';
}
