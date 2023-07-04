<?php

declare(strict_types=1);

namespace Books\Model;

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;

class Book implements AggregateRoot
{
    use AggregateRootBehaviour;

    public static function initiate(BookId $id): Book
    {
        $process = new static($id);
        //$process->recordThat(new ProcessWasInitiated($id));

        return $process;
    }
}
