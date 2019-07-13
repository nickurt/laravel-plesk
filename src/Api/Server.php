<?php

namespace nickurt\Plesk\Api;

class Server extends AbstractApi
{
    /**
     * @return mixed
     */
    public function index()
    {
        return $this->get('server');
    }

    /**
     * @param arary $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function init($params)
    {
        return $this->post('server/init', $params);
    }

    /**
     * @return mixed
     */
    public function ips()
    {
        return $this->get('server/ips');
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function license($params)
    {
        return $this->post('server/license', $params);
    }
}
