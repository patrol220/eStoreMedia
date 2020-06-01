<?php

namespace App\Parser\Service;

use App\Parser\Model\CsvProductModel;
use App\Parser\Model\ResponseProductModel;

class CsvService
{
    const STORAGE_DIRECTORY = 'data';
    const FILE_NAME = 'products-data';
    const HEADERS = ['product name', 'url', 'photo url', 'price', 'rates count', 'stars count'];

    public function clearAndCreateCsvFile()
    {
        if (!is_dir(self::STORAGE_DIRECTORY)) {
            mkdir(self::STORAGE_DIRECTORY);
        }

        file_put_contents($this->getCsvFileName(), implode(',', self::HEADERS) . "\n");
    }

    public function saveProduct(ResponseProductModel $product)
    {
        $fileRow = sprintf(
            "\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\"\n",
            $product->getName(),
            $product->getProductUrl(),
            $product->getPhotoUrl(),
            $product->getPrice(),
            $product->getRatesCount(),
            $product->getStarsCount()
        );

        file_put_contents($this->getCsvFileName(), $fileRow, FILE_APPEND);
    }

    /**
     * @return CsvProductModel[]
     */
    public function getAllProductsFromCsv(): array
    {
        $products = [];
        $handle = fopen($this->getCsvFileName(), 'r');

        fgetcsv($handle); //to omit first row
        while (($data = fgetcsv($handle)) !== false) {
            $products[] = new CsvProductModel(
                $data[0],
                $data[1],
                $data[2],
                $data[3],
                (int)$data[4],
                (int)$data[5]
            );
        }

        return $products;
    }

    private function getCsvFileName(): string
    {
        return sprintf('%s/%s.csv', self::STORAGE_DIRECTORY, self::FILE_NAME);
    }
}
