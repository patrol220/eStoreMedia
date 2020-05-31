<?php

namespace App\Parser\Service;

use App\Parser\Model\ResponseProductModel;

class CsvService
{
    const STORAGE_DIRECTORY = 'data';
    const FILE_NAME = 'products-data';
    const HEADERS = ['product name', 'url', 'photo url', 'price', 'rates count', 'stars count'];

    public function createCsvFile()
    {
        if (!is_dir(self::STORAGE_DIRECTORY)) {
            mkdir(self::STORAGE_DIRECTORY);
        }

        $fileName = sprintf('%s/%s.csv', self::STORAGE_DIRECTORY, self::FILE_NAME);

        file_put_contents($fileName, implode(',', self::HEADERS) . "\n");
    }

    public function saveProduct(ResponseProductModel $product)
    {
        $fileName = sprintf('%s/%s.csv', self::STORAGE_DIRECTORY, self::FILE_NAME);

        $fileRow = sprintf(
            "\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\"\n",
            $product->getName(),
            $product->getProductUrl(),
            $product->getPhotoUrl(),
            $product->getPrice(),
            $product->getRatesCount(),
            $product->getStarsCount()
        );

        file_put_contents($fileName, $fileRow, FILE_APPEND);
    }
}
