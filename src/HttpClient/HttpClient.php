<?php

namespace nickurt\Plesk\HttpClient;

class HttpClient implements HttpClientInterface
{
    /** @var \GuzzleHttp\Client */
    protected $client;

    /** @var array */
    protected $headers = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ];

    /** @var array */
    protected $options = [];

    /**
     * @param $path
     * @param $body
     * @param array $headers
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($path, $body, array $headers = [])
    {
        return $this->request($path, $body, 'DELETE', $headers);
    }

    /**
     * @param string $path
     * @param array $body
     * @param string $httpMethod
     * @param array $headers
     * @param array $options
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($path, $body, $httpMethod = 'GET', array $headers = [], array $options = [])
    {
        $fullPath = sprintf('%s:%d/%s/%s', $this->getOptions()['host'], '8443', 'api/v2', $path);

        $response = $this->getClient()->request($httpMethod, $fullPath, [
            'auth' => [$this->getOptions()['username'], $this->getOptions()['password']],
            'headers' => $this->getHeaders(),
            'body' => $body ? $body : null
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        if (!isset($this->client)) {
            $this->client = new \GuzzleHttp\Client();

            return $this->client;
        }

        return $this->client;
    }

    /**
     * @param $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * @param string $path
     * @param array $parameters
     * @param array $headers
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($path, array $parameters = [], array $headers = [])
    {
        return $this->request($path, $parameters, 'GET', $headers);
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
        return $this->request($path, $body, 'POST', $headers);
    }

    /**
     * @param $path
     * @param $body
     * @param array $headers
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put($path, $body, array $headers = [])
    {
        return $this->request($path, $body, 'PUT', $headers);
    }
}