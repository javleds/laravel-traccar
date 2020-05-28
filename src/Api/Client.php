<?php

namespace Javleds\Traccar\Api;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Arr;
use Javleds\Traccar\Exceptions\TraccarApiCallException;

class Client
{
    /** @var Client */
    private $client;

    public function __construct(string $baseUrl, string $username, string $password)
    {
        $this->client = new GuzzleClient([
            'base_uri' => $baseUrl,
            'auth'     => [$username, $password],
        ]);
    }

    /**
     * @throws Exception
     */
    public function get(string $endpoint, array $params = [], array $options = [])
    {
        $response = null;

        try {
            $response = $this->client->get($endpoint, $this->prepareData($params, $options));
        } catch (Exception $exception) {
            $this->handleException($exception);
        }

        return $this->buildResponse($response);
    }

    /**
     * @throws Exception
     */
    public function post(string $endpoint, array $params = [], array $options = [])
    {
        $response = null;

        try {
            $response = $this->client->post($endpoint, $this->prepareData($params, $options));
        } catch (Exception $exception) {
            $this->handleException($exception);
        }

        return $this->buildResponse($response);
    }

    /**
     * @throws Exception
     */
    public function put(string $endpoint, array $params = [], array $options = [])
    {
        $response = null;

        try {
            $response = $this->client->post($endpoint, $this->prepareData($params, $options));
        } catch (Exception $exception) {
            $this->handleException($exception);
        }

        return $this->buildResponse($response);
    }

    /**
     * @throws Exception
     */
    public function delete(string $endpoint, array $params = [], array $options = [])
    {
        try {
            $response = $this->client->delete($endpoint, $this->prepareData($params, $options));
            if ($response->getStatusCode() === 204) {
                return true;
            }
        } catch (Exception $exception) {
            $this->handleException($exception);
        }

        return false;
    }

    private function prepareData(array $params = [], array $options = []): array
    {
        $data = [];

        if (config('traccar.debug_requests', false)) {
            $data['debug'] = true;
        }

        if (Arr::get($options, 'content_type') === 'json') {
            $data['json'] = $params;
        } else {
            $data['query'] = http_build_query($params);
        }

        return array_merge($data, $options);
    }

    /**
     * @param mixed|null $response
     *
     * @return array|string
     * @throws Exception
     */
    private function buildResponse($response)
    {
        if ($response === null) {
            return [];
        }

        $contentType = $this->getContentType($response->getHeader('content-type'));
        switch ($contentType) {
            case 'application/json':
                return json_decode($response->getBody()->getContents());
            default:
                return $response->getBody()->getContents();
        }
    }

    /**
     * @param array|string $contentType
     *
     * @return string
     * @throws Exception
     */
    private function getContentType($contentType)
    {
        if (is_string($contentType)) {
            return $contentType;
        }

        if (count($contentType) === 0) {
            throw new Exception(
                'The request does not have a valid content-type header'
            );
        }

        return $contentType[0];
    }

    /**
     * @throws TraccarApiCallException
     */
    private function handleException(Exception $exception): void
    {
        $hasNullPointerException = strpos($exception->getMessage(), 'NullPointerException') !== false;
        if (!$hasNullPointerException) {
            throw new TraccarApiCallException($exception);
        }
    }
}
