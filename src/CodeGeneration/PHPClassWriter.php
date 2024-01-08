<?php

declare(strict_types=1);

namespace Atto\CodegenTools\CodeGeneration;

use PhpParser\Parser;
use PhpParser\ParserFactory;

final class PHPClassWriter
{
    private readonly Parser $parser;
    private readonly CodeFormatter $printer;

    public function __construct()
    {
        $this->parser = (new ParserFactory)->create(ParserFactory::ONLY_PHP7);
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