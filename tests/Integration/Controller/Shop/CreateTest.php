<?php

declare(strict_types=1);

namespace Books\Tests\Integration\Controller\Shop;

use Books\Tests\Integration\Controller\ControllerTestCase;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateTest extends ControllerTestCase
{
    #[Test]
    public function create_shop_expects_shop_created_response(): void
    {
        $shopData = ['name' => 'Test Shop',];

        $this->client->request(Request::METHOD_POST, '/api/shops', [], [], [], json_encode($shopData));
        $response = $this->client->getResponse();

        $responseData = json_decode($response->getContent(), true);
        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertSame('application/json', $response->headers->get('Content-Type'));
        $this->assertSame('Shop created successfully', $responseData['message']);
        $this->assertArrayHasKey('id', $responseData['data']);
        $this->assertSame($shopData['name'], $responseData['data']['name']);
    }
}
