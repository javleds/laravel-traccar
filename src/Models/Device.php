<?php

namespace Javleds\Traccar\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
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

    public static function find(string $id)
    {
        $response = Client::get(self::ENDPOINT, [
            'uniqueId' => $id,
        ]);

        $devices = Device::hydrate($response);

        return $devices->first() ?? null;
    }

    public static function destroy($id)
    {
        $url = sprintf('%s/%s', self::ENDPOINT, $id);
        Client::delete($url);

        return $id;
    }

    public function delete()
    {
        return self::destroy($this->id);
    }

    /**
     * @param $name
     * @param null $uniqueId
     * @param null $attributes
     * @return mixed
     * @throws \JsonException
     */
    public static function store($name, $uniqueId = null, $attributes = null)
    {
        $traccarAttributes = [
            'id' => -1,
            'name' => $name,
            'uniqueId' => $uniqueId ?? Str::uuid(),
            "phone" => '',
            "model" => '',
            "contact" => '',
            "category" => null,
            "status" => null,
            "lastUpdate" => null,
            "groupId" => 0,
            "disabled" => false,
        ];

        if (!empty($attributes)){
            $traccarAttributes = array_merge($traccarAttributes,$attributes);
        }

        $result = Client::post(self::ENDPOINT, [], [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($traccarAttributes, JSON_THROW_ON_ERROR)
        ]);

        return Device::hydrate([$result])->first();
    }
}
