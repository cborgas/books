<?php

declare(strict_types=1);

namespace Books\Tests\Integration\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class ControllerTestCase extends WebTestCase
{
    protected readonly \Symfony\Bundle\FrameworkBundle\KernelBrowser $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
        $this->client->disableReboot();
    }

    protected function getJsonResponse(): array
    {
        return json_decode($this->client->getResponse()->getContent(), true);
    }
}
