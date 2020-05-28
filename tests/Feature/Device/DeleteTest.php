<?php

namespace Javleds\Traccar\Tests\Feature\Device;

use Exception;
use Javleds\Traccar\Exceptions\TraccarApiCallException;
use Javleds\Traccar\Models\Device;
use Javleds\Traccar\Tests\BaseTestCase;

class DeleteTest extends BaseTestCase
{
    /**
     * @dataProvider getDevicesIds
     * @throws Exception
     */
    public function testDelete(string $deviceId): void
    {
        $device = Device::find($deviceId);
        $device->delete();

        self::assertNull(Device::find($deviceId));
    }

    public function getDevicesIds(): array
    {
        return [
            ['607024'],
        ];
    }
}
