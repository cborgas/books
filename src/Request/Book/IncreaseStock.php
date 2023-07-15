<?php

declare(strict_types=1);

namespace Books\Request\Book;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class IncreaseStock
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Positive]
        public int $amount
    ) {}
}
