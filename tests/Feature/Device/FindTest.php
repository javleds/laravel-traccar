<?php

namespace Javleds\Traccar\Tests\Feature;

use Javleds\Traccar\Exceptions\TraccarApiCallException;
use Javleds\Traccar\Models\Device;
use Javleds\Traccar\Tests\BaseTestCase;
use Exception;

class FindTest extends BaseTestCase
{
    /**
     * @dataProvider getDevicesIds
     */
    public function testFind(string $deviceId, bool $expectsNull): void
    {
        $device = Device::find($deviceId);

        if ($expectsNull) {
            self::assertNull($device);
        } else {
            self::assertNotNull($device->getName());
            self::assertNotEmpty($device->getName());
        }
    }

    public function getDevicesIds(): array
    {
        return [
            ['607024', false],
            ['659855', true],
        ];
    }
}
