<?php

namespace nickurt\Plesk;

class Plesk
{
    /**
     * @var
     */
    protected $app;

    /**
     * @var array
     */
    protected $servers = [];

    /**
     * @var
     */
    protected $client;

    /**
     * Plesk constructor.
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param null $name
     * @return mixed|\PleskX\Api\Client
     */
    public function server($name = null)
    {
        $name = $name ?: $this->getDefaultServer();

        return $this->servers[$name] = $this->get($name);
    }

    /**
     * @return mixed
     */
    public function getDefaultServer()
    {
        return $this->app['config']['plesk-servers.default'];
    }

    /**
     * @param $name
     * @return mixed|\PleskX\Api\Client
     */
    protected function get($name)
    {
        return $this->servers[$name] ?? $this->resolve($name);
    }

    /**
     * @param $name
     * @return \PleskX\Api\Client
     */
    protected function resolve($name)
    {
        $config = $this->getConfig($name);

        $this->client = new \PleskX\Api\Client($config['host']);
        $this->client->setCredentials(
            $config['username'],
            $config['password']
        );

        return $this->client;
    }


    /**
     * @param $name
     * @return mixed
     */
    protected function getConfig($name)
    {
        return $this->app['config']["plesk-servers.servers.{$name}"];
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->client, $name], $arguments);
    }
}
