<?php

namespace nickurt\Plesk\HttpClient;

interface HttpClientInterface
{
    /**
     * @param $path
     * @param $body
     * @param array $headers
     * @return mixed
     */
    public function delete($path, $body, array $headers = []);

    /**
     * @param $path
     * @param array $parameters
     * @param array $headers
     * @return mixed
     */
    public function get($path, array $parameters = [], array $headers = []);

    /**
     * @return mixed
     */
    public function getHeaders();

    /**
     * @return mixed
     */
    public function getOptions();

    /**
     * @param $path
     * @param $body
     * @param array $headers
     * @return mixed
     */
    public function path($path, $body, array $headers = []);

    /**
     * @param $path
     * @param $body
     * @param array $headers
     * @return mixed
     */
    public function post($path, $body, array $headers = []);

    /**
     * @param $path
     * @param $body
     * @param array $headers
     * @return mixed
     */
    public function put($path, $body, array $headers = []);

    /**
     * @param $path
     * @param $body
     * @param string $httpMethod
     * @param array $headers
     * @param array $options
     * @return mixed
     */
    public function request($path, $body, $httpMethod = 'GET', array $headers = [], array $options = []);

    /**
     * @param array $headers
     * @return mixed
     */
    public function setHeaders(array $headers);

    /**
     * @param array $options
     * @return mixed
     */
    public function setOptions(array $options);
}