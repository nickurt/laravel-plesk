<?php

namespace nickurt\Plesk\Api;

class Cli extends AbstractApi
{
    /**
     * @param int $id
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function call($id, $params)
    {
        return $this->post('cli/' . $id . '/call', $params);
    }

    /**
     * @return mixed
     */
    public function commands()
    {
        return $this->get('cli/commands');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function ref($id)
    {
        return $this->get('cli/' . $id . '/ref');
    }
}
