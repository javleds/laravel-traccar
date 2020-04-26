<?php

namespace Javleds\Traccar\Models;

use DateTime;
use Javleds\Traccar\Contracts\Importable;
use Javleds\Traccar\Facades\Client;

class Device implements Importable
{
    const ENDPOINT = '/devices';

    /** @var int */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $uniqueId;

    /** @var string */
    public $status;

    /** @var boolean */
    public $disabled;

    /** @var DateTime */
    public $lastUpdate;

    /** @var int */
    public $positionId;

    /** @var int */
    public $groupId;

    /** @var string */
    public $phone;

    /** @var string */
    public $model;

    /** @var string */
    public $contact;

    /** @var string */
    public $category;

    /** @var int[] */
    public $geofenceIds;

    /** @var object */
    public $attributes;

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public static function find(string $id): self
    {
        $response = Client::get(self::ENDPOINT, [
            'id' => $id,
        ]);

        /** @var Device $device */
        $device = Device::fromArray($response);

        return $device;
    }

    public function destroy(): string
    {
        $url = sprintf('%s/%s', self::ENDPOINT, $this->id);
        Client::delete($url);

        return $this->id;
    }

    public static function fromArray(array $object): Importable
    {
        $device = new Device();
        $device->id = $object['id'];
        $device->name = $object['name'];
        $device->uniqueId = $object['uniqueId'];
        $device->status = $object['status'];
        $device->disabled = $object['disabled'];
        $device->lastUpdate = $object['lastUpdate'];
        $device->positionId = $object['positionId'];
        $device->groupId = $object['groupId'];
        $device->phone = $object['phone'];
        $device->model = $object['model'];
        $device->contact = $object['contact'];
        $device->category = $object['category'];
        $device->geofenceIds = $object['geofenceIds'];
        $device->attributes = $object['attributes'];

        return $device;
    }
}
