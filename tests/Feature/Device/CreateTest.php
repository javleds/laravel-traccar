<?php

namespace Javleds\Traccar\Tests\Feature\Device;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Javleds\Traccar\Models\Device;
use PHPUnit\Framework\TestCase;
use Javleds\Traccar\Tests\BaseTestCase;


class CreateTest extends BaseTestCase
{

    public function testCreateNew(): void
    {

        $device_attributes = [
            'id' => -1,
            'name' => $this->faker->name,
            'uniqueId' => Str::uuid(),
            "phone" => '',
            "model" => '',
            "contact" => '',
            "category" => null,
            "status" => null,
            "lastUpdate" => null,
            "groupId" => 0,
            "disabled" => false,
        ];

        $deviceModel = Device::store($device_attributes['name']);
        
        $this->assertSame($device_attributes['name'], $deviceModel->getName());
    }
}
