<?php

namespace nickurt\Plesk\Api;

class Domains extends Operator
{
    /**
     * @return mixed
     */
    public function all()
    {
        return $this->client->request('GET', 'domains');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->client->request('GET', 'domains/'.$id);
    }
}
