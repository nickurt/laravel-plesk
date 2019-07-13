<?php

namespace nickurt\Plesk\Tests\Endpoints;

class DomainsTest extends BaseEndpointTest
{
    /** @test */
    public function it_can_create_a_new_domain()
    {
        $params = '{"name":"example.com","description":"My website","hosting_type":"virtual","hosting_settings":{"ftp_login":"test_login","ftp_password":"test_pwd"},"base_domain":{"id":7,"name":"example.com","guid":"b623e93d-dc72-4102-b5f0-ded427cf0fb1"},"parent_domain":{"id":7,"name":"example.com","guid":"b623e93d-dc72-4102-b5f0-ded427cf0fb1"},"owner_client":{"id":7,"login":"owner","guid":"b623e93d-dc72-4102-b5f0-ded427cf0fb1","external_id":"b623e93d-dc72-4102-b5f0-ded427cf0fb1"},"ip_addresses":["93.184.216.34","2606:2800:220:1:248:1893:25c8:1946"],"ipv4":["93.184.216.34"],"ipv6":["2606:2800:220:1:248:1893:25c8:1946"],"plan":{"name":"Unlimited"}}';

        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "POST",
                "https://plesk-local.tld:8443/api/v2/domains",
                [
                    "Content-Type" => "application/json",
                    "Accxept" => "application/json",
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
            'id' => 100,
            'guid' => '18b78dd1-2b43-44f7-9599-56ccb56a85dc',
        ], $this->plesk->domains()->store(json_decode($params, true)));
    }

    /** @test */
    public function it_can_delete_an_existing_domain()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "DELETE",
                "https://plesk-local.tld:8443/api/v2/domains/100",
                [
                    "Content-Type" => "application/json",
                    "Accxept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"id":100,"guid":"18b78dd1-2b43-44f7-9599-56ccb56a85dc"}'
            )
        );

        $this->assertSame([
            'id' => 100,
            'guid' => '18b78dd1-2b43-44f7-9599-56ccb56a85dc',
        ], $this->plesk->domains()->destroy(100));
    }

    /** @test */
    public function it_can_get_all_the_domains()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/domains",
                [
                    "Content-Type" => "application/json",
                    "Accxept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '[{"id":1,"created":"2016-11-13","name":"example.com","ascii_name":"ascii-example.com","guid":"b623e93d-dc72-4102-b5f0-ded427cf0fb1","hosting_type":"virtual"}]'
            )
        );

        $this->assertSame([[
            'id' => 1,
            'created' => '2016-11-13',
            'name' => 'example.com',
            'ascii_name' => 'ascii-example.com',
            'guid' => 'b623e93d-dc72-4102-b5f0-ded427cf0fb1',
            'hosting_type' => 'virtual'
        ]], $this->plesk->domains()->index());
    }

    /** @test */
    public function it_can_get_invalid_domain_details()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/domains/3",
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
        ], $this->plesk->domains()->show(3));
    }

    /** @test */
    public function it_can_get_the_domain_client_information()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/domains/100/client",
                [
                    "Content-Type" => "application/json",
                    "Accxept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"id":100,"guid":"18b78dd1-2b43-44f7-9599-56ccb56a85dc"}'
            )
        );

        $this->assertSame([
            'id' => 100,
            'guid' => '18b78dd1-2b43-44f7-9599-56ccb56a85dc',
        ], $this->plesk->domains()->client(100));
    }

    /** @test */
    public function it_can_get_the_domain_status_information()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/domains/100/status",
                [
                    "Content-Type" => "application/json",
                    "Accxept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"status":"active"}'
            )
        );

        $this->assertSame(['status' => 'active'], $this->plesk->domains()->status(100));
    }

    /** @test */
    public function it_can_get_valid_domain_details()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/domains/1",
                [
                    "Content-Type" => "application/json",
                    "Accxept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"id":1,"created":"2016-11-13","name":"example.com","ascii_name":"ascii-example.com","guid":"b623e93d-dc72-4102-b5f0-ded427cf0fb1","hosting_type":"virtual"}'
            )
        );

        $this->assertSame([
            'id' => 1,
            'created' => '2016-11-13',
            'name' => 'example.com',
            'ascii_name' => 'ascii-example.com',
            'guid' => 'b623e93d-dc72-4102-b5f0-ded427cf0fb1',
            'hosting_type' => 'virtual'
        ], $this->plesk->domains()->show(1));
    }

    /** @test */
    public function it_can_update_an_existing_domain()
    {
        $params = '{"name":"example.com","description":"My website","hosting_type":"virtual","hosting_settings":{"ftp_login":"test_login","ftp_password":"test_pwd"},"base_domain":{"id":7,"name":"example.com","guid":"b623e93d-dc72-4102-b5f0-ded427cf0fb1"},"parent_domain":{"id":7,"name":"example.com","guid":"b623e93d-dc72-4102-b5f0-ded427cf0fb1"},"owner_client":{"id":7,"login":"owner","guid":"b623e93d-dc72-4102-b5f0-ded427cf0fb1","external_id":"b623e93d-dc72-4102-b5f0-ded427cf0fb1"},"ip_addresses":["93.184.216.34","2606:2800:220:1:248:1893:25c8:1946"],"ipv4":["93.184.216.34"],"ipv6":["2606:2800:220:1:248:1893:25c8:1946"],"plan":{"name":"Unlimited"}}';

        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "PUT",
                "https://plesk-local.tld:8443/api/v2/domains/100",
                [
                    "Content-Type" => "application/json",
                    "Accxept" => "application/json",
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
            'id' => 100,
            'guid' => '18b78dd1-2b43-44f7-9599-56ccb56a85dc',
        ], $this->plesk->domains()->update(100, json_decode($params, true)));
    }
}