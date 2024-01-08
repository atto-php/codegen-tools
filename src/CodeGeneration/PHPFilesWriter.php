<?php

declare(strict_types=1);

namespace Atto\CodegenTools\CodeGeneration;


final class PHPFilesWriter
{
    private PHPClassWriter $phpClassWriter;

    public function __construct(
        private readonly string $directory,
        private readonly string $baseNamespace
    ) {
        if (!file_exists($this->directory)) {
            mkdir($this->directory, recursive: true);
        }

        if (!is_writable($this->directory)) {
            throw new \RuntimeException('Cannot write to directory');
        }

        $this->phpClassWriter = new PHPClassWriter();

    }

    public function writeFiles(PHPClassDefinitionProducer $classDefinitions): array
    {
        $createdFiles = [];

        foreach ($classDefinitions as $classDefinition) {
            $directory = $this->makeDirectory($classDefinition->getNamespace());

            if (!file_exists($directory)) {
                mkdir($directory, recursive: true);
            }

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

        return str_replace('\\','/', $name);
    }
}