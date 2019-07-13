<?php

namespace nickurt\Plesk\Api;

class Domains extends AbstractApi
{
    /**
     * @param int $id
     * @return mixed
     */
    public function client($id)
    {
        return $this->get('domains/' . $id . '/client');
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function destroy($id)
    {
        return $this->delete('domains/' . $id);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->get('domains');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->get('domains/' . $id);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function status($id)
    {
        return $this->get('domains/' . $id . '/status');
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store($params)
    {
        return $this->post('domains', $params);
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($id, $params)
    {
        return $this->put('domains/' . $id, $params);
    }
}
