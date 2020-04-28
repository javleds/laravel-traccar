<?php

namespace Javleds\Traccar\Tests\Feature;

use Javleds\Traccar\Exceptions\TraccarApiCallException;
use Javleds\Traccar\Models\Device;
use Javleds\Traccar\Tests\BaseTestCase;

class DeviceTest extends BaseTestCase
{
    /**
     * @dataProvider getDevicesIds
     */
    public function testFind(int $deviceId, bool $expectsException): void
    {
        if ($expectsException) {
            $this->expectException(TraccarApiCallException::class);
        }
        // Please ensure to have at least one device connected to your traccar container
        $device = Device::find($deviceId);
        self::assertNotNull($device->getName());
        self::assertNotEmpty($device->getName());
    }

    public function getDevicesIds(): array
    {
        return [
            [1, false],
            [2, true],
        ];
    }
}
