<?php

namespace nickurt\Plesk\Api;

class Cli extends AbstractApi
{
    /**
     * @param $id
     * @param $body
     */
    public function call($id, $body)
    {
        //
    }

    /**
     * @return mixed
     */
    public function commands()
    {
        return $this->get('cli/commands');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function ref($id)
    {
        return $this->get('cli/' . $id . '/ref');
    }
}
