<?php

declare(strict_types=1);

namespace Books\Tests\Integration\Controller\Shop;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateTest extends WebTestCase
{
    private \Symfony\Bundle\FrameworkBundle\KernelBrowser $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
        $this->client->disableReboot();
    }

    #[Test]
    public function createShopExpectsShopToBeCreated(): void
    {
        $shopData = [
            'name' => 'Test Shop',
        ];

        $this->client->request(Request::METHOD_POST, '/shops', [], [], [], json_encode($shopData));

        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertSame('application/json', $response->headers->get('Content-Type'));

        $responseData = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('code', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);

        $this->assertSame(200, $responseData['code']);
        $this->assertSame('Shop created successfully', $responseData['message']);

        $this->assertArrayHasKey('id', $responseData['data']);
        $this->assertArrayHasKey('name', $responseData['data']);

        $this->assertSame($shopData['name'], $responseData['data']['name']);
    }
}
