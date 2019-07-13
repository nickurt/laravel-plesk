<?php

namespace nickurt\Plesk\Api;

use nickurt\Plesk\Client;

abstract class AbstractApi implements ApiInterface
{
    /** @var \nickurt\Plesk\Client */
    public $client;

    /**
     * AbstractApi constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $path
     * @param array $parameters
     * @param array $headers
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($path, array $parameters = [], array $headers = [])
    {
        return $this->client->getHttpClient()->delete(
            $path,
            $parameters,
            $headers
        );
    }

    /**
     * @param string $path
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function get($path, array $parameters = [], array $headers = [])
    {
        return $this->client->getHttpClient()->get(
            $path,
            $parameters,
            $headers
        );
    }

    public function path($path, $body, array $headers = [])
    {
        //
    }

    /**
     * @param string $path
     * @param array $body
     * @param array $headers
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($path, $body, array $headers = [])
    {
        return $this->client->getHttpClient()->post(
            $path,
            $body,
            $headers
        );
    }

    /**
     * @param string $path
     * @param array $body
     * @param array $headers
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put($path, $body, array $headers = [])
    {
        return $this->client->getHttpClient()->put(
            $path,
            $body,
            $headers
        );
    }
}