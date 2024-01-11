<?php

namespace App\Exceptions;

use Exception;

class InvalidOrderException extends Exception
{
    public function context(): array
    {
        return ['order_id' => 123];
    }
}
