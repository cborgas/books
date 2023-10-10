<?php

declare(strict_types=1);

namespace Books\Books\Infrastructure\Request;

use Books\Model\BookId;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class BookIdResolver implements ValueResolverInterface
{
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $argumentType = $argument->getType();
        if ($argumentType !== BookId::class) {
            return [];
        }

        $value = $request->attributes->get($argument->getName());
        return [BookId::fromString($value)];
    }
}
