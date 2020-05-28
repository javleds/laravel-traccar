<?php

namespace Javleds\Traccar\Contracts;

interface Importable
{
    public static function fromArray(array $object): Importable;
}
