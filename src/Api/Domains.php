<?php

namespace nickurt\Plesk\Api;

class Domains extends AbstractApi
{
    /**
     * @return mixed
     */
    public function all()
    {
        return $this->get('domains');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function read($id)
    {
        return $this->get('domains/'.$id);
    }
}
