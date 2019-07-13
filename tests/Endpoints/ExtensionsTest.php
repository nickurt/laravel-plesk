<?php

namespace nickurt\Plesk\Tests\Endpoints;

class ExtensionsTest extends BaseEndpointTest
{
    /** @test */
    public function it_can_destroy_an_existing_extension()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "DELETE",
                "https://plesk-local.tld:8443/api/v2/extensions/letsencrypt",
                [
                    "Content-Type" => "application/json",
                    "Accxept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"status":"success"}'
            )
        );

        $this->assertSame(["status" => "success"], $this->plesk->extensions()->destroy('letsencrypt'));
    }

    /** @test */
    public function it_can_disable_an_existing_extension()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "PUT",
                "https://plesk-local.tld:8443/api/v2/extensions/letsencrypt/disable",
                [
                    "Content-Type" => "application/json",
                    "Accxept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"status":"success"}'
            )
        );

        $this->assertSame(["status" => "success"], $this->plesk->extensions()->disable('letsencrypt'));
    }

    /** @test */
    public function it_can_enable_an_existing_extension()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "PUT",
                "https://plesk-local.tld:8443/api/v2/extensions/letsencrypt/enable",
                [
                    "Content-Type" => "application/json",
                    "Accxept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"status":"success"}'
            )
        );

        $this->assertSame(["status" => "success"], $this->plesk->extensions()->enable('letsencrypt'));
    }

    /** @test */
    public function it_can_get_all_the_extensions()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/extensions",
                [
                    "Content-Type" => "application/json",
                    "Accxept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '[{"id":"letsencrypt","name":"Let\'s Encrypt","version":"2.6.1","release":"398","active":true}]'
            )
        );

        $this->assertSame([[
            "id" => "letsencrypt",
            "name" => "Let's Encrypt",
            "version" => "2.6.1",
            "release" => "398",
            "active" => true
        ]], $this->plesk->extensions()->index());
    }

    /** @test */
    public function it_can_get_invalid_extensions_details()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/extensions/3",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                404,
                [],
                '{"code":400,"message":"Account with this name already exists"}'
            )
        );

        $this->assertSame([
            "code" => 400,
            "message" => "Account with this name already exists"
        ], $this->plesk->extensions()->show(3));
    }

    /** @test */
    public function it_can_get_valid_extension_details()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/extensions/1",
                [
                    "Content-Type" => "application/json",
                    "Accxept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"id":"letsencrypt","name":"Let\'s Encrypt","version":"2.6.1","release":"398","active":true}'
            )
        );

        $this->assertSame([
            "id" => "letsencrypt",
            "name" => "Let's Encrypt",
            "version" => "2.6.1",
            "release" => "398",
            "active" => true
        ], $this->plesk->extensions()->show(1));
    }

    /** @test */
    public function it_can_install_a_new_extension()
    {
        $params = '{"id":"letsencrypt","url":"https://example.com/catalog/letsencrypt.zip","file":"/path/to/extension.zip"}';

        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "POST",
                "https://plesk-local.tld:8443/api/v2/extensions",
                [
                    "Content-Type" => "application/json",
                    "Accxept" => "application/json",
                ],
                $params
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"status":"success"}'
            )
        );

        $this->assertSame(["status" => "success"], $this->plesk->extensions()->store(json_decode($params, true)));
    }
}