<?php

declare(strict_types=1);

namespace Books\Tests\Utility;

use Ramsey\Uuid\Uuid;

class UniqueBookName
{
    public static function generate(string $prefix = 'Name'): string
    {
        return sprintf('%s-%s', $prefix, Uuid::uuid4()->toString());
    }
}
