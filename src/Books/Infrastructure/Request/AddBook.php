<?php

declare(strict_types=1);

namespace Books\Books\Infrastructure\Request;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class AddBook
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 4, max: 256)]
        public string $name
    ) {}
}
