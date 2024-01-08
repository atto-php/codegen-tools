<?php

declare(strict_types=1);

namespace Atto\CodegenTools\CodeGeneration;

use PhpParser\PrettyPrinter\Standard;

final class CodeFormatter extends Standard
{
    protected function pMaybeMultiline(array $nodes, bool $trailingComma = false): string {
        if ($this->hasNodeWithComments($nodes) || count($nodes) >= 3) {
            return $this->pCommaSeparatedMultiline($nodes, $trailingComma) . $this->nl;
        } else {
            return $this->pCommaSeparated($nodes);
        }
    }
}