# Laravel traccar API Wrapper

# Client Facade
You can use the client in order to make request to the global api,
it is auto=registered as TraccarClient by default but you can 
change it by adding the alias in the `conf/app.php`

```php
<?php

return [
    // ...
    'aliases' => [
        // ...
          'CustomName' => Javleds\TraccarApi\Facades\Client::class,
        // ...
    ],
];
```

It could be used while we finish to develop each endpoint 
for the current API.

### Usage
 |Method|Is static|Parameters|Return type|Can throws|
 |---|---|---|---|---|
 |get|[x]|$url: string<br>$parameters: array<k,v><br>$options: array<k,v>|mixed|Exception|
 |post|[x]|$url: string<br>$parameters: array<k,v><br>$options: array<k,v>|mixed|Exception|
 |put|[x]|$url: string<br>$parameters: array<k,v><br>$options: array<k,v>|mixed|Exception|
 |delete|[x]|$url: string<br>$parameters: array<k,v><br>$options: array<k,v>|mixed|Exception|


# Models

### Device

##### Properties

|Name|Type|
|---:|:---:|
|$id|int|
|$name|string|
|$uniqueId|string|
|$status|string|
|$disabled|boolean|
|$lastUpdate|DateTime|
|$positionId|int|
|$groupId|int|
|$phone|string|
|$model|string|
|$contact|string|
|$category|string|
|$geofenceIds|int[]|
|$attributes|object|

##### Methods

|Method|Is static|Parameters|Return type|Can throws|
|---|---|---|---|---|
|find|[x]|$id: string|Device|Exception|
|delete|[ ]| |string|Exception|
|getId|[ ]| |string| |
|getName|[ ]| |string| |
