<?php

namespace nickurt\Plesk\Api;

class Operator
{
    public $client;

    public function __construct($client)
    {
        $this->client = $client;
    }
}
