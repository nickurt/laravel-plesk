<?php

namespace nickurt\Plesk\Tests\Endpoints;

class ClientsTest extends BaseEndpointTest
{
    /** @test */
    public function it_can_destroy_an_existing_client()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "DELETE",
                "https://plesk-local.tld:8443/api/v2/clients/7",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"id":100,"guid":"18b78dd1-2b43-44f7-9599-56ccb56a85dc"}'
            )
        );

        $this->assertSame([
            "id" => 100,
            "guid" => "18b78dd1-2b43-44f7-9599-56ccb56a85dc",
        ], $this->plesk->clients()->destroy(7));
    }

    /** @test */
    public function it_can_get_all_the_clients()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/clients",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ],
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '[{"id":7,"created":"2016-11-13","name":"John Smith","company":"Plesk","login":"john-unit-test","status":0,"email":"john_smith@msn.com","locale":"en-US","guid":"18b78dd1-2b43-44f7-9599-56ccb56a85dc","owner_login":"admin","external_id":"link:12345","description":"Nice guy","password":"setup","type":"reseller"}]'
            )
        );

        $this->assertSame([[
            "id" => 7,
            "created" => "2016-11-13",
            "name" => "John Smith",
            "company" => "Plesk",
            "login" => "john-unit-test",
            "status" => 0,
            "email" => "john_smith@msn.com",
            "locale" => "en-US",
            "guid" => "18b78dd1-2b43-44f7-9599-56ccb56a85dc",
            "owner_login" => "admin",
            "external_id" => "link:12345",
            "description" => "Nice guy",
            "password" => "setup",
            "type" => "reseller"
        ]], $this->plesk->clients()->index());
    }

    /** @test */
    public function it_can_get_invalid_client_details()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/clients/3",
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
        ], $this->plesk->clients()->show(3));
    }

    /** @test */
    public function it_can_get_valid_client_details()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/clients/7",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"id":7,"created":"2016-11-13","name":"John Smith","company":"Plesk","login":"john-unit-test","status":0,"email":"john_smith@msn.com","locale":"en-US","guid":"18b78dd1-2b43-44f7-9599-56ccb56a85dc","owner_login":"admin","external_id":"link:12345","description":"Nice guy","password":"setup","type":"reseller"}'
            )
        );

        $this->assertSame([
            "id" => 7,
            "created" => "2016-11-13",
            "name" => "John Smith",
            "company" => "Plesk",
            "login" => "john-unit-test",
            "status" => 0,
            "email" => "john_smith@msn.com",
            "locale" => "en-US",
            "guid" => "18b78dd1-2b43-44f7-9599-56ccb56a85dc",
            "owner_login" => "admin",
            "external_id" => "link:12345",
            "description" => "Nice guy",
            "password" => "setup",
            "type" => "reseller"
        ], $this->plesk->clients()->show(7));
    }

    /** @test */
    public function it_can_store_a_new_client()
    {
        $params = '{"id":7,"created":"2016-11-13","name":"John Smith","company":"Plesk","login":"john-unit-test","status":0,"email":"john_smith@msn.com","locale":"en-US","guid":"18b78dd1-2b43-44f7-9599-56ccb56a85dc","owner_login":"admin","external_id":"link:12345","description":"Nice guy","password":"setup","type":"reseller"}';

        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "POST",
                "https://plesk-local.tld:8443/api/v2/clients",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ],
                $params
            ),
            new \GuzzleHttp\Psr7\Response(
                201,
                [],
                '{"id":100,"guid":"18b78dd1-2b43-44f7-9599-56ccb56a85dc"}'
            )
        );

        $this->assertSame([
            "id" => 100,
            "guid" => "18b78dd1-2b43-44f7-9599-56ccb56a85dc",
        ], $this->plesk->clients()->store(json_decode($params, true)));
    }

    /** @test */
    public function it_can_update_an_existing_client()
    {
        $params = '{"id":7,"created":"2016-11-13","name":"John Smith","company":"Plesk","login":"john-unit-test","status":0,"email":"john_smith@msn.com","locale":"en-US","guid":"18b78dd1-2b43-44f7-9599-56ccb56a85dc","owner_login":"admin","external_id":"link:12345","description":"Nice guy","password":"setup","type":"reseller"}';

        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "PUT",
                "https://plesk-local.tld:8443/api/v2/clients/7",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ],
                $params
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"id":100,"guid":"18b78dd1-2b43-44f7-9599-56ccb56a85dc"}'
            )
        );

        $this->assertSame([
            "id" => 100,
            "guid" => "18b78dd1-2b43-44f7-9599-56ccb56a85dc",
        ], $this->plesk->clients()->update(7, json_decode($params, true)));
    }
}