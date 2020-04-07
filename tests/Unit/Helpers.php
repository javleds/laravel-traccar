<?php

namespace Javleds\Traccar\Tests\Unit\Helpers;

use Javleds\Traccar\Tests\BaseTestCase;

class Helpers extends BaseTestCase
{
    public function testGetBaseDir(): void
    {
        $expected = realpath(
            sprintf('%s/Helpers.php', __DIR__)
        );
        $result = realpath(
            getBaseDir('tests/Unit/Helpers.php')
        );
        $this->assertSame($expected, $result);
    }
}
