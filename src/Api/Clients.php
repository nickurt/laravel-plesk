<?php

namespace nickurt\Plesk\Api;

class Clients extends Operator
{
    /**
     * @return mixed
     */
    public function all()
    {
        return $this->client->request('GET', 'clients');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->client->request('GET', 'clients/'.$id);
    }
}
