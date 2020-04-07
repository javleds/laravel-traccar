<?php

function getBaseDir(string $path = ''): string
{
    return sprintf(
        '%s/../%s',
        __DIR__,
        $path
    );
}
