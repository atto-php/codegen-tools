<?php

declare(strict_types=1);

namespace Atto\CodegenTools\ClassDefinition;

final class PHPClassDefinitionProducer implements \Iterator
{
    public function __construct(private \Generator $generator)
    {
    }

    public function current(): PHPClassDefinition
    {
        return $this->generator->current();
    }

    public function next(): void
    {
        $this->generator->next();
    }

    public function key(): mixed
    {
        return $this->generator->key();
    }

    public function valid(): bool
    {
        return $this->generator->valid();
    }

    public function rewind(): void
    {
        $this->generator->rewind();
    }
}