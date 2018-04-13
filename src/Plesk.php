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
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->base, $method], $args);
    }

    /**
     * @param null $name
     * @return mixed|Api\Client
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
        return $this->app['config']['plesk.default'];
    }

    /**
     * @param $name
     * @return mixed|Api\Client
     */
    protected function get($name)
    {
        return $this->servers[$name] ?? $this->resolve($name);
    }

    /**
     * @param $name
     * @return Api\Client
     */
    protected function resolve($name)
    {
        $config = $this->getConfig($name);

        $this->base = new \nickurt\Plesk\Api\Base();
        $this->base->setHost($config['host']);
        $this->base->setCredentials(
            $config['username'],
            $config['password']
        );

        return $this->base;
    }

    /**
     * @param $name
     * @return mixed
     */
    protected function getConfig($name)
    {
        return $this->app['config']["plesk.servers.{$name}"];
    }
}
