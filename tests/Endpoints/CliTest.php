<?php

namespace nickurt\Plesk\Tests\Endpoints;

class CliTest extends BaseEndpointTest
{
    /** @test */
    public function it_can_call_a_cli_command()
    {
        $params = '{"params":["--get","FullHostName"],"env":{"PSA_PASSWORD":"password"}}';

        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "POST",
                "https://plesk-local.tld:8443/api/v2/cli/20/call",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ],
                $params
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"code":0,"stdout":"Done","stderr":"Execution failed"}'
            )
        );

        $this->assertSame(['code' => 0, 'stdout' => 'Done', 'stderr' => 'Execution failed'], $this->plesk->cli()->call(20, json_decode($params, true)));
    }


    /** @test */
    public function it_can_get_all_the_cli_commands()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/cli/commands",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '["string"]'
            )
        );

        $this->assertSame(["string"], $this->plesk->cli()->commands());
    }

    /** @test */
    public function it_can_get_invalid_cli_command_reference_details()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/cli/1/ref",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"code":400,"message":"Account with this name already exists"}'
            )
        );

        $this->assertSame([
            "code" => 400,
            "message" => "Account with this name already exists"
        ], $this->plesk->cli()->ref(1));
    }

    /** @test */
    public function it_can_get_valid_cli_command_reference_details()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/cli/3/ref",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"allowed_commands":{},"allowed_options":{}}'
            )
        );

        $this->assertSame([
            "allowed_commands" => [],
            "allowed_options" => []
        ], $this->plesk->cli()->ref(3));
    }
}