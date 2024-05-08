<?php

declare(strict_types=1);

namespace Atto\CodegenTools\PackageDefinition;

final class PackageDefinitionWithComposerTemplateFile implements PackageDefinition
{
    public function __construct(
        private readonly string $baseNamespace,
        private readonly string $packageName,
        private readonly string $composerFileTemplatePath
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
        $composerData = json_decode(file_get_contents($this->composerFileTemplatePath));

        if (!is_array($composerData)) {
            throw new \Exception('composer file template could not be read');
        }

        return $composerData;
    }
}