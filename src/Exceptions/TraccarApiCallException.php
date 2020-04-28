<?php

namespace Javleds\Traccar\Exceptions;

use Exception;
use Throwable;

class TraccarApiCallException extends Exception
{
    public const DEFAULT_MESSAGE = 'There was an error while trying to retrieve your resource';

    public function __construct(Exception $exception)
    {
        $message = sprintf('%s:: Native error -> %s', self::DEFAULT_MESSAGE, $exception->getMessage());
        parent::__construct($message, $exception->getCode(), $exception->getPrevious());
    }
}
