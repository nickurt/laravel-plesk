<?php

namespace nickurt\Plesk\Tests\Endpoints;

class ServerTest extends BaseEndpointTest
{
    /** @test */
    public function it_can_get_server_ip_addresses()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/server/ips",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ]
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '[{"ipv4":"93.184.216.34","ipv6":"2606:2800:220:1:248:1893:25c8:1946","netmask":"255.255.255.0","interface":"eth0","type":"exclusive"}]'
            )
        );

        $this->assertSame([[
            "ipv4" => "93.184.216.34",
            "ipv6" => "2606:2800:220:1:248:1893:25c8:1946",
            "netmask" => "255.255.255.0",
            "interface" => "eth0",
            "type" => "exclusive"
        ]], $this->plesk->server()->ips());
    }

    /** @test */
    public function it_can_installing_license_key()
    {
        $params = '{"key":"/RjdfLic1RwpNPkEnLlxNJkJCPzNDWSRDOyVeJDI/MSo1RlFEMD4+VTEzKTk3S0pfVjFOJTZFXzMpTEVPQC5JRjdUR0RZCk0hMSJYOzYhVFxPI14jTFJPRSlaRFI0VjZWPEYiT1s5T0opJV8+NCMnUigvQ1o7K0U+QEtbISc1MlMqLV0KTSorUDVfMzxHNUkrSksxWzZVNVZJXTc5T18xQVNNNzRXWTo3WVkmW0I/J2AnYC4iJTlTP1grSCdYS0E+RApNPVteRk43RCNAVFpVO0dBO1hZMjo+K0pQNEsiLj5UUDQlLDA7XyVZIVo/QypGJiJcW1FbJF1fVVxUJy5ECk1HXCpSUzwtUVYoJzwsVV47MT5bJD8wWlgyYCo/KTM0QUJFMmAuOjc7QypMWylfQiFVP05PRj05LCY5SkgKTVRTWE9cRi84OUgxJDpgLl5RPEtPPkE4RCUtXU06NixHLi1ZL0ZBVSkyVkBVUCgiN0YrKyoyXTJMJ08qVwpNIk4lOyFeLFwmIiQ4NkBgMUEmTDRcWDdJKihZTEMhTENOJEMiKV0wIzkkSU4qMTEzO1BIJjo4K0U3LzU6Ck0wPCNTUytONjAhQEFROCFbUDI5OktVLlEsMlY9ND1gSjpgJVMjLS4tVzsrRzpAME8yVTpLVmAiT1NHLFAKTVU0SSowNVo1IShEWipAO10tRlsxQldVSkZSKDcyPjpWLik5I0YzWD0yVTs9NTlNL1dASyglXk5YN1U4UgpNTV8sXD0tRTQuLkBFMVk2I0REUCItXyVMNlRPRkEyTEA7Pl9QO10jUSI6I1tNIzVRU0VZVE1HWDInIzk4Ck1XRUNPVz5CSFUjUSo4K0IvOFlDWSNTLydXSls7KD9VTD8+WzUqQEA5Uic0S1BMJSowOk9fQ0QvQThUVCEKTT1AKiJFKztAKCFXNl9ORDhUVlleOCU5JS8rJzc+JEZUXigzMDs4PDtbNkUpPD8vUiJAREQoTkxUPlQ2JgpNVFdbVz9bT10mVy5FVEkyXD5MPSIkMkRVVipKWTolXVhRTzkoM1tLLSJRJFlXNTRTYEBNWy1UUV09K04wCk1SVWBbLyckXj5KXjsnUzgyRzE3QVUlWilXX0ZCX1BGMkRMSThHXjZBWE5FTUBEMjBgRTomVTpVLy1WRCQKTVtWUyQ+XDcsRUA+XU0hXz4pKFxBJ1JCNUQ6XCEnQjoyPFw","code":"AB1C23-4DEF56-7GHI89-JK1L23-MNP456","additional":false}';

        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "POST",
                "https://plesk-local.tld:8443/api/v2/server/license",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ],
                $params
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"status":"success"}'
            )
        );

        $this->assertSame(["status" => "success"], $this->plesk->server()->license(json_decode($params, true)));
    }

    /** @test */
    public function it_can_performing_initial_server_setup()
    {
        $params = '{"admin":{"name":"John Smith","email":"john_smith@plesk.com","company":"Plesk","phone":"+41 31 528 12 23","fax":"+41 31 528 12 23","address":"Vordergasse 59","city":"Schaffhausen","state":"Kanton Schaffhausen","post_code":"8200","country":"CH","send_announce":false,"locale":"en-US","multiple_sessions":false},"password":"setup","server_name":"my-plesk-server.com"}';

        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "POST",
                "https://plesk-local.tld:8443/api/v2/server/init",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ],
                $params
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"status":"success"}'
            )
        );

        $this->assertSame(["status" => "success"], $this->plesk->server()->init(json_decode($params, true)));
    }

    /** @test */
    public function it_can_server_meta_information()
    {
        $this->mockApiClientRequestResponse(
            new \GuzzleHttp\Psr7\Request(
                "GET",
                "https://plesk-local.tld:8443/api/v2/server",
                [
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                ],
            ),
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                '{"platform":"Unix","hostname":"example.com","guid":"baa58292-fee0-4ecb-9da1-bba0cc5adea7","panel_version":"17.9.3","panel_revision":"1711e2bceff6fd6656c821b8cb6444c2726f3784","panel_build_date":"2018-06-20","panel_update_version":"10","extension_version":"1.1.0","extension_release":"10"}'
            )
        );

        $this->assertSame([
            "platform" => "Unix",
            "hostname" => "example.com",
            "guid" => "baa58292-fee0-4ecb-9da1-bba0cc5adea7",
            "panel_version" => "17.9.3",
            "panel_revision" => "1711e2bceff6fd6656c821b8cb6444c2726f3784",
            "panel_build_date" => "2018-06-20",
            "panel_update_version" => "10",
            "extension_version" => "1.1.0",
            "extension_release" => "10",
        ], $this->plesk->server()->index());
    }
}