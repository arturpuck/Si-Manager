<?php

namespace App\Exceptions;

use Exception;

class FailedValidationException extends Exception
{
    public function __construct(protected array $errors){}

    public function getErrorsList() : array {
        return $this->errors;;
    }
}
