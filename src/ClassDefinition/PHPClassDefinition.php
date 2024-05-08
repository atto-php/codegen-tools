<?php

declare(strict_types=1);

namespace Atto\CodegenTools\ClassDefinition;

interface PHPClassDefinition
{
    public function getNamespace(): string;

    public function getName(): string;

    public function getCode(): string;
}