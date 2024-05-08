<?php

declare(strict_types=1);

namespace Atto\CodegenTools\PackageDefinition;

final class PackageDefinitionWithComposerTemplateArray implements PackageDefinition
{
    public function __construct(
        private readonly string $baseNamespace,
        private readonly string $packageName,
        private readonly array $composerFileTemplate
    ) {
    }

    public function getBaseNamespace(): string
    {
        return $this->baseNamespace;
    }

    public function getPackageName(): string
    {
        return $this->packageName;
    }

    public function getComposerTemplateArray(): array
    {
        return $this->composerFileTemplate;
    }
}