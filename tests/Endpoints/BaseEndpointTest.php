<?php

namespace nickurt\Plesk\Tests\Endpoints;

use PHPUnit\Framework\TestCase;

abstract class BaseEndpointTest extends TestCase
{
    /** @var \GuzzleHttp\Client */
    protected $httpClient;

    /** @var \nickurt\Plesk\Client */
    protected $plesk;

    /**
     * @param \GuzzleHttp\Psr7\Request $expectedRequest
     * @param \GuzzleHttp\Psr7\Response $expectedResponse
     */
    public function mockApiClientRequestResponse(\GuzzleHttp\Psr7\Request $expectedRequest, \GuzzleHttp\Psr7\Response $expectedResponse)
    {
        $this->httpClient = $this->createMock(\GuzzleHttp\Client::class);

        $this->plesk = new \nickurt\Plesk\Client();
        $this->plesk->setHost('https://plesk-local.tld');
        $this->plesk->setCredentials('username', 'password');
        $this->plesk->getHttpClient()->setClient($this->httpClient);

        $this->httpClient->method('request')->willReturnCallback(function ($method, $uri, $options) use ($expectedRequest, $expectedResponse) {
            $this->assertEquals($expectedRequest->getMethod(), $method);

            $this->assertEquals((string)$expectedRequest->getUri(), $uri);

            $this->assertSame($options['body'], json_decode($expectedRequest->getBody()->getContents(), true));

            return $expectedResponse;
        });
    }
}