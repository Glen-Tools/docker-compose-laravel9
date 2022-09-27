<?php

namespace App\Exceptions;

use Exception;

class ParameterException extends Exception
{
    /**
     * Get all of the validation error messages.
     *
     * @return array
     */
    public function errors()
    {
        return $this->message;
    }
}
