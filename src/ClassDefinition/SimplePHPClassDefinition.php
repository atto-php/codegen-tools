<?php

declare(strict_types=1);

namespace Atto\CodegenTools\ClassDefinition;

final class SimplePHPClassDefinition implements PHPClassDefinition
{
    public function __construct(
        private readonly string $namespace,
        private readonly string $name,
        private readonly string $code
    )
    {
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}