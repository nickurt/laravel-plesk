<?php

namespace nickurt\Plesk\HttpClient;

class HttpClient implements HttpClientInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var array
     */
    protected $headers = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ];

    /**
     * HttpClient constructor.
     */
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    public function delete($path, $body, array $headers = [])
    {
        //
    }

    /**
     * @param $path
     * @param array $parameters
     * @param array $headers
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($path, array $parameters = [], array $headers = [])
    {
        return $this->request($path, $parameters, 'GET', $headers);
    }

    /**
     * @param $path
     * @param $body
     * @param string $httpMethod
     * @param array $headers
     * @param array $options
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($path, $body, $httpMethod = 'GET', array $headers = [], array $options = [])
    {
        $fullPath = sprintf('%s:%d/%s/%s', $this->getOptions()['host'], '8443', 'api/v2', $path);

        $response = $this->client->request($httpMethod, $fullPath, [
            'auth' => [$this->getOptions()['username'], $this->getOptions()['password']],
            'headers' => $this->getHeaders()
        ]);

        return json_decode($response->getBody(), true);
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