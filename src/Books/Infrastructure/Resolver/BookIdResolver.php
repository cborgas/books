<?php

declare(strict_types=1);

namespace Books\Books\Infrastructure\Resolver;

use Books\Books\Domain\Model\BookId;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

#[AutoconfigureTag(
    name: 'controller.argument_value_resolver',
    attributes: ['name' => 'bookId', 'priority' => 150]
)]
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
