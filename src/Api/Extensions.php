<?php

namespace nickurt\Plesk\Api;

class Extensions extends AbstractApi
{
    /**
     * @return mixed
     */
    public function all()
    {
        return $this->get('extensions');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function read($id)
    {
        return $this->get('extensions/' . $id);
    }
}
