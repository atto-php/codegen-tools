<?php

declare(strict_types=1);

namespace Atto\CodegenTools;

use Atto\CodegenTools\CodeGeneration\PHPClassDefinitionProducer;
use Atto\CodegenTools\CodeGeneration\PHPFilesWriter;

final class PackageGenerator
{
    public function __construct(public readonly string $destination)
    {

    }

    public function writePackage(PackageDefinition $composerDefinition, PHPClassDefinitionProducer $classDefinitions): array
    {
        $fileGenerator = new PHPFilesWriter(
            $this->destination . '/' . 'src',
            $composerDefinition->baseNamespace
        );

        $createdFiles = $fileGenerator->writeFiles($classDefinitions);
        $createdFiles[] = $this->destination . '/' . 'composer.json';

        file_put_contents(
            $this->destination . '/' . 'composer.json',
            $this->generateComposerJson($composerDefinition)
        );

        return $createdFiles;

        $d = new \RecursiveDirectoryIterator($this->destination);
        foreach ($d as $item) {
            $existingFiles[] = $item->getPathname();
        }

        array_diff($existingFiles, $createdFiles);
    }

    private function generateComposerJson(PackageDefinition $packageDefinition): string
    {
        $composerFile = json_decode(file_get_contents($packageDefinition->composerFileTemplatePath));
        $composerFile['name'] = $packageDefinition->packageName;
        $baseNamespace = trim($packageDefinition->baseNamespace, '\\') . '\\';
        $composerFile['autoload'] = ['psr-4' => [$baseNamespace => 'src/']];

        return json_encode($composerFile, \JSON_PRETTY_PRINT);
    }
}