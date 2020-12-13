<?php

namespace Spot\Shipment\Excel\Factories;

use Spot\Shipment\Excel\Concerns\MapsCsvSettings;
use Spot\Shipment\Excel\Concerns\WithCustomCsvSettings;
use Spot\Shipment\Excel\Exceptions\NoTypeDetectedException;
use Spot\Shipment\Excel\Files\TemporaryFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Reader\IReader;

class ReaderFactory
{
    use MapsCsvSettings;

    /**
     * @param object        $import
     * @param TemporaryFile $file
     * @param string        $readerType
     *
     * @throws Exception
     * @return IReader
     */
    public static function make($import, TemporaryFile $file, string $readerType = null): IReader
    {
        $reader = IOFactory::createReader(
            $readerType ?: static::identify($file)
        );

        if (method_exists($reader, 'setReadDataOnly')) {
            $reader->setReadDataOnly(config('excel.imports.read_only', true));
        }

        if ($reader instanceof Csv) {
            static::applyCsvSettings(config('excel.imports.csv', []));

            if ($import instanceof WithCustomCsvSettings) {
                static::applyCsvSettings($import->getCsvSettings());
            }

            $reader->setDelimiter(static::$delimiter);
            $reader->setEnclosure(static::$enclosure);
            $reader->setEscapeCharacter(static::$escapeCharacter);
            $reader->setContiguous(static::$contiguous);
            $reader->setInputEncoding(static::$inputEncoding);
        }

        return $reader;
    }

    /**
     * @param TemporaryFile $temporaryFile
     *
     * @throws NoTypeDetectedException
     * @return string
     */
    private static function identify(TemporaryFile $temporaryFile): string
    {
        try {
            return IOFactory::identify($temporaryFile->getLocalPath());
        } catch (Exception $e) {
            throw new NoTypeDetectedException(null, null, $e);
        }
    }
}
