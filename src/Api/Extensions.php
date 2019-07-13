<?php

namespace nickurt\Plesk\Api;

class Extensions extends AbstractApi
{
    /**
     * @param string $identifier
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function destroy($identifier)
    {
        return $this->delete('extensions/' . $identifier);
    }

    /**
     * @param string $identifier
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function disable($identifier)
    {
        return $this->put('extensions/' . $identifier . '/disable', '');
    }

    /**
     * @param string $identifier
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function enable($identifier)
    {
        return $this->put('extensions/' . $identifier . '/enable', '');
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->get('extensions');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->get('extensions/' . $id);
    }

    /**
     * @param $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store($params)
    {
        return $this->post('extensions', $params);
    }
}
