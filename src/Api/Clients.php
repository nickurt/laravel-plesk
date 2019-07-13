<?php

namespace nickurt\Plesk\Api;

class Clients extends AbstractApi
{
    /**
     * @param int $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function destroy($id)
    {
        return $this->delete('clients/' . $id);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->get('clients');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->get('clients/' . $id);
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store($params)
    {
        return $this->post('clients', $params);
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($id, $params)
    {
        return $this->put('clients/' . $id, $params);
    }
}
