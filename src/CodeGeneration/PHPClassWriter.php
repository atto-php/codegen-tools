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
        $this->parser = (new ParserFactory)->create(ParserFactory::ONLY_PHP7);
        $this->printer = new CodeFormatter();
    }

    public function writeClass(string $directory, PHPClassDefinition $classDefinition): string
    {
        $filename = sprintf('%s/%s', $directory, $classDefinition->getName());

        try {
            $code = $this->printer->prettyPrintFile(
                $this->parser->parse($classDefinition->getCode()) ?? []
            );
        } catch (\RuntimeException $e) {
            $filename = $filename . 'INVALID';
            $code = $classDefinition->getCode();
        }

        file_put_contents("$filename.php", $code);

        return $filename;
    }
}
