<?php

declare(strict_types=1);

namespace Books\Tests\Integration;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelloControllerTest extends WebTestCase
{
    #[Test]
    public function helloEndpointExpectsHelloWorldResponse(): void
    {
        $client = self::createClient();

        $client->request('GET', '/hello');
        $response = $client->getResponse();

        $this->assertEquals('Hello, world!', $response->getContent());
    }
}
