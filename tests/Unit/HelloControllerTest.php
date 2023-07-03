<?php

declare(strict_types=1);

namespace Books\Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Books\Controller\HelloController;

class HelloControllerTest extends TestCase
{
    #[Test]
    public function helloExpectsHelloWorldResponse(): void
    {
        $controller = new HelloController();

        $this->assertEquals('Hello, world!', $controller->hello()->getContent());
    }
}
