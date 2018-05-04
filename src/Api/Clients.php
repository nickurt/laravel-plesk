<?php

namespace nickurt\Plesk\Api;

class Clients extends AbstractApi
{
    /**
     * @return mixed
     */
    public function all()
    {
        return $this->get('clients');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function read($id)
    {
        return $this->get('clients/'.$id);
    }
}
