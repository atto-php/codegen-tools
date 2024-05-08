<?php

declare(strict_types=1);

namespace Atto\CodegenTools\PackageDefinition;

interface PackageDefinition
{

    public function getPackageName(): string;

    public function getBaseNamespace(): string;

    public function getComposerTemplateArray(): array;
}