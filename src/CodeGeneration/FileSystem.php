<?php

declare(strict_types=1);

namespace Atto\CodegenTools\CodeGeneration;

final class FileSystem
{
    public static function ensureDirectoryExistsAndIsWritable(string $directory): void
    {
        if (!self::isAWriteableDirectory($directory)) {
            throw new \RuntimeException('Cannot write to directory');
        }

        file_exists($directory) || mkdir($directory, recursive: true);
    }

    private static function isAWriteableDirectory(string $directory): bool
    {
        while (!file_exists($directory)) {
            $directory = dirname($directory);
        }

        if (is_dir($directory) && is_writable($directory)) {
            return true;
        }

        return false;
    }
}