<?php

namespace nickurt\Plesk\Tests\Endpoints;

class AuthenticationTest extends \nickurt\Plesk\tests\Endpoints\BaseEndpointTest
{
    /** @test */
    public function it_can_generate_a_secret_key()
    {
        $params = '{"ip":"195.214.233.128","login":"","description":"Secret key for Administrator"}';

        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "POST",
                "https://plesk-local.tld:8443/api/v2/auth/keys",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ],
                $params
            ),
            new \GuzzleHttp\Psr7\Response(
                201,
                [],
                '{"key": "c5b239d1-8eb6-8cee-76b7-aa16be37fee8"}'
            )
        );

        $this->assertSame(["key" => "c5b239d1-8eb6-8cee-76b7-aa16be37fee8",], $this->plesk->authentication()->keys(json_decode($params, true)));
    }
}