<?php

namespace Pontifex\Rest\Api\Fields\Exceptions;

use Exception;

class NoFieldsException extends Exception implements IFieldsException
{
    protected $message = 'No fields';
}
