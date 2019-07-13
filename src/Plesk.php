<?php

namespace nickurt\Plesk;

class Plesk
{
    /** @var \Illuminate\Foundation\Application */
    protected $app;

    /** @var \nickurt\Plesk\Client */
    protected $client;

    /** @var array */
    protected $servers = [];

    /**
     * Plesk constructor.
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->client, $method], $args);
    }

    /**
     * @param null|string $name
     * @return \nickurt\Plesk\Client
     */
    public function server($name = null)
    {
        $name = $name ?: $this->getDefaultServer();

        return $this->servers[$name] = $this->get($name);
    }

    /**
     * @return array
     */
    public function getDefaultServer()
    {
        return $this->app['config']['plesk.default'];
    }

    /**
     * @param string $name
     * @return \nickurt\Plesk\Client
     */
    protected function get($name)
    {
        return $this->servers[$name] ?? $this->resolve($name);
    }

    /**
     * @param string $name
     * @return \nickurt\Plesk\Client
     */
    protected function resolve($name)
    {
        $config = $this->getConfig($name);

        $this->client = new \nickurt\Plesk\Client();
        $this->client->setHost($config['host']);
        $this->client->setCredentials(
            $config['username'],
            $config['password']
        );

        return $this->client;
    }

    /**
     * @param string $name
     * @return array
     */
    protected function getConfig($name)
    {
        return $this->app['config']["plesk.servers.{$name}"];
    }
}
