<?php

namespace nickurt\Plesk\Api;

class Authentication extends Operator
{
    /**
     * @param $params
     * @return mixed
     */
    public function keys($params)
    {
        return $this->client->request('POST', 'auth/keys', $params);
    }
}
