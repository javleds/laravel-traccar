<?php

namespace Javleds\Traccar\Tests\Feature\Device;

use Javleds\Traccar\Exceptions\TraccarApiCallException;
use Javleds\Traccar\Models\Device;
use Javleds\Traccar\Tests\BaseTestCase;

class DestroyTest extends BaseTestCase
{
    /**
     * @dataProvider getDevicesIds
     */
    public function testDestroy(string $deviceId): void
    {
        Device::destroy($deviceId);
        self::assertNull(Device::find($deviceId));
    }

    public function getDevicesIds(): array
    {
        return [
            ['607024'],
        ];
    }
}
