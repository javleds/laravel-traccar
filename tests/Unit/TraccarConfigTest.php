<?php

namespace Javleds\Traccar\Tests\Unit;

use Javleds\Traccar\Tests\BaseTestCase;

class TraccarConfigTest extends BaseTestCase
{
    const CONFIG_FILENAME = 'traccar';

    /**
     * @dataProvider getRequiredValues
     */
    public function testConfigShouldHaveRequiredValues(string $requiredValue): void
    {
        $this->assertNotNull(config($this->getConfigKey($requiredValue)));
    }

    private function getConfigKey(string $key): string
    {
        return sprintf(
            '%s.%s',
            self::CONFIG_FILENAME,
            $key
        );
    }

    public function getRequiredValues(): array
    {
        return [
            ['base_url'],
        ];
    }
}
