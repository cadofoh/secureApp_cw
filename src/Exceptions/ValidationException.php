<?php

class ValidationException extends Exception
{
    private $errors;
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
}
    