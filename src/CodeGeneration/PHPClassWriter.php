<?php

declare(strict_types=1);

namespace Atto\CodegenTools\CodeGeneration;

use Atto\CodegenTools\ClassDefinition\PHPClassDefinition;
use PhpParser\Parser;
use PhpParser\ParserFactory;

final class PHPClassWriter
{
    private readonly Parser $parser;
    private readonly CodeFormatter $printer;

    public function __construct()
    {
        if (method_exists(ParserFactory::class, 'createForNewestSupportedVersion')) {
            $this->parser = (new ParserFactory())
                ->createForNewestSupportedVersion();
        } else {
            $this->parser = (new ParserFactory())
                ->create(ParserFactory::ONLY_PHP7);
        }

        $this->printer = new CodeFormatter();
    }

    public function writeClass(string $directory, PHPClassDefinition $classDefinition): string
    {
        $filename = sprintf('%s/%s.php', $directory, $classDefinition->getName());

        file_put_contents(
            $filename,
            $this->printer->prettyPrintFile($this->parser->parse($classDefinition->getCode()))
        );

        return $filename;
    }
}
