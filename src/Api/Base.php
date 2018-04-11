<?php

namespace nickurt\Plesk\Api;

class Base
{
    /**
     * @var
     */
    protected $host;

    /**
     * @var
     */
    protected $port;

    /**
     * @var
     */
    protected $username;

    /**
     * @var
     */
    protected $password;

    /**
     * @return Clients
     */
    public function clients()
    {
        return new \nickurt\Plesk\Api\Clients($this);
    }

    /**
     * @return Domains
     */
    public function domains()
    {
        return new \nickurt\Plesk\Api\Domains($this);
    }

    /**
     * @param $method
     * @param $endpoint
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $endpoint, $params = [])
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request($method, sprintf('%s/%s', $this->getApiUrl(), $endpoint), [
            'auth' => [$this->username, $this->password],
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->getHost() . ':8443/api/v2';
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @param $username
     * @param $password
     */
    public function setCredentials($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
}
