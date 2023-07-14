<?php

declare(strict_types=1);

namespace Books\Tests\Integration\Controller\Book;

use Books\Tests\Integration\Controller\ControllerTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookControllerTestCase extends ControllerTestCase
{
    public function createBook(string $name = 'Test Book'): Response
    {
        $bookData = ['name' => $name];
        $this->client->request(Request::METHOD_POST, '/api/books', content: json_encode($bookData));

        return $this->client->getResponse();
    }
}
