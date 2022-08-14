<?php

namespace App\Http\Exceptions;

use Exception;

Class FailedValidationException extends Exception
{
    public function __construct(private array $errors)
    {
    }

    public function getErrors() : array 
    {
        return $this->errors;
    }
}