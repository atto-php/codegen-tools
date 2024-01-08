<?php

declare(strict_types=1);

namespace Atto\CodegenTools\CodeGeneration;


use Atto\CodegenTools\FileSystem;

final class PHPFilesWriter
{
    private PHPClassWriter $phpClassWriter;

    public function __construct(
        private readonly string $directory,
        private readonly string $baseNamespace
    ) {
        FileSystem::ensureDirectoryExistsAndIsWritable($this->directory);

        $this->phpClassWriter = new PHPClassWriter();

    }

    public function writeFiles(PHPClassDefinitionProducer $classDefinitions): array
    {
        $createdFiles = [];

        foreach ($classDefinitions as $classDefinition) {
            $directory = $this->makeDirectory($classDefinition->getNamespace());

            FileSystem::ensureDirectoryExistsAndIsWritable($directory);

            $createdFiles[] = $this->phpClassWriter->writeClass($directory, $classDefinition);
        }

        return $createdFiles;
    }

    private function makeDirectory(string $classNamespace): string
    {
        $name = str_replace(
            trim($this->baseNamespace, '\\'),
            '',
            trim($classNamespace, '\\')
        );

        //@TODO ensure directory ends in a /
        return $this->directory . str_replace('\\','/', $name);
    }
}