<?php
/**
 * Description of LocationsHttpClientTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Tests\App\Client;

use Dotsplatform\LocationsApiSdk\Client\LocationsHttpClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class LocationsHttpClientTest extends TestCase
{
    public function testCallsExpectOneGuzzleClientReused(): void
    {
        $locationsHttpClient = $this->makeClientWithMockedResponses([
            new Response(404),
            new Response(404),
            new Response(404),
        ]);

        $locationsHttpClient->findAccount($this->uuid());
        $locationsHttpClient->findAccount($this->uuid());
        $locationsHttpClient->findAccount($this->uuid());

        $this->assertSame(1, $locationsHttpClient->builtClientsCount);
        $this->assertSame(0, $locationsHttpClient->mockHandler->count());
    }

    /**
     * @param Response[] $responses
     */
    private function makeClientWithMockedResponses(array $responses): LocationsHttpClient
    {
        $mockHandler = new MockHandler($responses);

        return new class($mockHandler) extends LocationsHttpClient {
            public int $builtClientsCount = 0;

            public function __construct(
                public readonly MockHandler $mockHandler,
            ) {
            }

            protected function buildClient(): Client
            {
                $this->builtClientsCount++;

                return new Client([
                    'handler' => HandlerStack::create($this->mockHandler),
                    'http_errors' => false,
                ]);
            }
        };
    }
}
