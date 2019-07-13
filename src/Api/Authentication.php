<?php

namespace nickurt\Plesk\Api;

class Authentication extends AbstractApi
{
    /**
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function keys($params)
    {
        return $this->post('auth/keys', $params);
    }
}
