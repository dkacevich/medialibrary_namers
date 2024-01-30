<?php

namespace Dkacevich\MedialibraryNamers\File;

use Random\RandomException;
use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\Support\FileNamer\FileNamer;

class RandomFileNamer extends FileNamer
{
    /**
     * @throws RandomException
     */
    public function originalFileName(string $fileName): string
    {
        $pathInfo = pathinfo($fileName, PATHINFO_FILENAME);

        $position = $pathInfo.bin2hex(random_bytes(10));

        return md5($position);
    }

    public function conversionFileName(string $fileName, Conversion $conversion): string
    {
        $strippedFileName = pathinfo($fileName, PATHINFO_FILENAME);

        return "{$strippedFileName}-{$conversion->getName()}";
    }

    public function responsiveFileName(string $fileName): string
    {
        return pathinfo($fileName, PATHINFO_FILENAME);
    }
}
