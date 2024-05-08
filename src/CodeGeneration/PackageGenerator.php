<?php

declare(strict_types=1);

namespace Atto\CodegenTools\CodeGeneration;

use Atto\CodegenTools\ClassDefinition\PHPClassDefinitionProducer;
use Atto\CodegenTools\PackageDefinition\PackageDefinition;

final class PackageGenerator
{
    public function __construct(public readonly string $destination)
    {
    }

    public function writePackage(PackageDefinition $composerDefinition, PHPClassDefinitionProducer $classDefinitions): array
    {
        $fileGenerator = new PHPFilesWriter(
            $this->destination . '/' . 'src',
            $composerDefinition->getBaseNamespace()
        );

        $createdFiles = $fileGenerator->writeFiles($classDefinitions);
        $createdFiles[] = $this->destination . '/' . 'composer.json';

        file_put_contents(
            $this->destination . '/' . 'composer.json',
            $this->generateComposerJson($composerDefinition)
        );

        return $createdFiles;
    }

    private function generateComposerJson(PackageDefinition $packageDefinition): string
    {
        $composerFile = $packageDefinition->getComposerTemplateArray();
        $composerFile['name'] = $packageDefinition->getPackageName();
        $baseNamespace = trim($packageDefinition->getBaseNamespace(), '\\') . '\\';
        $composerFile['autoload'] = ['psr-4' => [$baseNamespace => 'src/']];

        return json_encode($composerFile, \JSON_PRETTY_PRINT);
    }
}