<?php

declare(strict_types=1);

namespace Atto\CodegenTools;

final class PackageDefinition
{
    public function __construct(
        public readonly string $baseNamespace,
        public readonly string $packageName,
        public readonly string $composerFileTemplatePath
    ) {
    }


}