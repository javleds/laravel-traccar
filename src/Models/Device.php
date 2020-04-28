<?php

namespace Javleds\Traccar\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Javleds\Traccar\Facades\Client;

class Device extends Model
{
    const ENDPOINT = 'devices';

    protected $fillable = [
        'id',
        'name',
        'uniqueId',
        'status',
        'disabled',
        'lastUpdate',
        'positionId',
        'groupId',
        'phone',
        'model',
        'contact',
        'category',
        'geofenceIds',
        'attributes',
    ];

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

        $devices = Device::hydrate($response);

        return $devices->first() ?? null;
    }

    public static function destroy($id): string
    {
        $url = sprintf('%s/%s', self::ENDPOINT, $id);
        Client::delete($url);

        return $id;
    }

    public function delete()
    {
        $url = sprintf('%s/%s', self::ENDPOINT, $this->id);
        Client::delete($url);

        return $this->id;
    }
}
