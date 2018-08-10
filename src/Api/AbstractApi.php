<?php

namespace nickurt\Plesk\Api;

use nickurt\Plesk\Client;

abstract class AbstractApi implements ApiInterface
{
    /**
     * @var Client
     */
    public $client;

    /**
     * AbstractApi constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function delete($path, $body, array $headers = [])
    {
        //
    }

    /**
     * @param $path
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function get($path, array $parameters = [], array $headers = [])
    {
        $response = $this->client->getHttpClient()->get(
            $path,
            $parameters,
            $headers
        );

        return $response;
    }

    public function path($path, $body, array $headers = [])
    {
        //
    }

    public function post($path, $body, array $headers = [])
    {
        //
    }

    public function put($path, $body, array $headers = [])
    {
        //
    }
}